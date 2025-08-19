import { Component, OnInit } from '@angular/core';
import { CartService } from '../../services/cart.service';
import { CartItem } from '../../models/cart-item.model';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.page.html',
  styleUrls: ['./cart.page.scss'],
  standalone: false
})
export class CartPage implements OnInit {
  cartItems: CartItem[] = [];

  constructor(private cartService: CartService) {}

  ngOnInit() {
    this.cartService.cartItems$.subscribe(items => {
      this.cartItems = items;
    });
  }

  updateQuantity(item: CartItem, event: any) {
    const value = Number(event.detail.value);
    this.cartService.updateItem(item, value, item.weight);
  }

  updateWeight(item: CartItem, event: any) {
    const value = Number(event.detail.value);
    this.cartService.updateItem(item, item.quantity, value);
  }

  removeItem(item: CartItem) {
    this.cartService.removeFromCart(item);
  }

  getTotal(): number {
    return this.cartService.getTotal();
  }

  async payCart(): Promise<void> {
    //TODO: Implement payment logic
  }
}
