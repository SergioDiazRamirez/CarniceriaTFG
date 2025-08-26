import { Component, OnInit } from '@angular/core';
import { CartService } from '../../services/cart.service';
import { Item } from '../../models/item.model';
import { AlertController } from '@ionic/angular';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.page.html',
  styleUrls: ['./cart.page.scss'],
  standalone: false
})
export class CartPage implements OnInit {
  cartItems: Item[] = [];

  constructor(private cartService: CartService, private alertCtrl: AlertController) {}

  ngOnInit() {
    this.cartService.cartItems$.subscribe(items => {
      this.cartItems = items;
    });
  }

  updateQuantity(item: Item, event: any) {
    const value = Number(event.detail.value);
    this.cartService.updateItem(item, value, item.weight);
  }

  updateWeight(item: Item, event: any) {
    const value = Number(event.detail.value);
    this.cartService.updateItem(item, item.quantity, value);
  }

  async removeItem(item: Item) {
        const alert = await this.alertCtrl.create({
      header: 'Eliminar producto',
      message: '¿Seguro que deseas eliminar este producto?',
      buttons: [
        { text: 'Cancelar', role: 'cancel' },
        {
          text: 'Eliminar',
          handler:  () => { this.cartService.removeFromCart(item) }          
        }
      ]
    });
    await alert.present();
  }

  getTotal(): number {
    return this.cartService.getTotal();
  }

  async payCart(): Promise<void> {
    //TODO: Implement payment logic
  }
}
