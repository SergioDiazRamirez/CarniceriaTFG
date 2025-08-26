import { Injectable } from '@angular/core';
import { BehaviorSubject, map } from 'rxjs';
import { Item } from '../models/item.model';
import { Product } from '../models/product.model';
import { Preferences } from '@capacitor/preferences';

@Injectable({
  providedIn: 'root'
})
export class CartService {
  private cartItems: Item[] = [];
  private cartItemsSubject = new BehaviorSubject<Item[]>([]);
  cartItems$ = this.cartItemsSubject.asObservable();
  cartCount$ = this.cartItems$.pipe(
    map(items => items.reduce((acc, item) => acc + item.quantity, 0))
  );
  private STORAGE_KEY = 'cart_items';

  constructor() {
    this.loadCart();
  }
  async addToCart(product: Product, quantity: number = 1, weight?: number) {
    const existingItem = this.cartItems.find(item =>
      item.product.id === product.id &&
      item.weight === weight
    );

    if (existingItem) {
      existingItem.quantity += quantity;
      existingItem.total_price = this.calculateTotal(existingItem);
    } else {
      const newItem: Item = {
        product,
        quantity,
        weight,
        total_price: 0
      };
      newItem.total_price = this.calculateTotal(newItem);
      this.cartItems.push(newItem);
    }
    this.cartItemsSubject.next([...this.cartItems]);
    await this.saveCart();
  }

  async updateItem(item: Item, quantity: number, weight?: number) {
    item.quantity = quantity;
    item.weight = weight;
    item.total_price = this.calculateTotal(item);
    this.cartItemsSubject.next([...this.cartItems]);
    await this.saveCart();
  }

  async removeFromCart(item: Item) {
    this.cartItems = this.cartItems.filter(i => i !== item);
    this.cartItemsSubject.next([...this.cartItems]);
    await this.saveCart();
  }

  async clearCart() {
    this.cartItems = [];
    this.cartItemsSubject.next([]);
    await Preferences.remove({ key: this.STORAGE_KEY });

  }

  getTotal(): number {
    return this.cartItems.reduce((acc, item) => acc + item.total_price, 0);
  }

  private calculateTotal(item: Item): number {
    const price = item.product.price;

    switch (item.product.sale_type_id) {
      case 1: // Weight only
        return price * (item.weight || 1);
      case 2: // Quantity only
        return price * item.quantity;
      case 3: // Weight + quantity
        return price * (item.weight || 1) * item.quantity;
      default:
        return 0;
    }
  }

  private async saveCart() {
    await Preferences.set({
      key: this.STORAGE_KEY,
      value: JSON.stringify(this.cartItems)
    });
    this.cartItemsSubject.next([...this.cartItems]);
  }

  private async loadCart() {
    const { value } = await Preferences.get({ key: this.STORAGE_KEY });
    if (value) {
      this.cartItems = JSON.parse(value);
      this.cartItemsSubject.next([...this.cartItems]);
    }
  }
}
