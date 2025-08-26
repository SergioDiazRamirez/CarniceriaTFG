import { Component, OnInit } from '@angular/core';
import { OrderService } from '../../services/order.service';
import { Order } from 'src/app/models/order.model';
import { Router } from '@angular/router';

@Component({
  selector: 'app-orders',
  templateUrl: './orders.page.html',
  styleUrls: ['./orders.page.scss'],
  standalone: false,
})
export class OrdersPage implements OnInit {
  orders: Order[] = [];
  loading = false;

  constructor(private orderService: OrderService, private router: Router) { }

  ngOnInit() {
    this.loadOrders();
  }

  loadOrders() {
    this.loading = true;
    this.orderService.getUserOrders().subscribe({
      next: (orders) => {
        this.orders = orders;
        this.loading = false;
      },
      error: () => this.loading = false
    });
  }

  goToOrderDetail(orderId: number) {
    this.router.navigate(['/tabs/order-detail', orderId]);
  }

  formatDate(date: string): string {
    const d = new Date(date);
    return d.toLocaleDateString('es-ES', {
      day: '2-digit',
      month: '2-digit',
      year: '2-digit',
    });
  }

  statusKey(id: number): string {
    switch (id) {
      case 1: return 'STATUS_PENDING';
      case 2: return 'STATUS_PROCESSING';
      case 3: return 'STATUS_SHIPPING';
      case 4: return 'STATUS_PICKUP';
      case 5: return 'STATUS_COMPLETED';
      case 6: return 'STATUS_CANCELED';
      default: return 'STATUS_ERROR';
    }
  }

  statusClass(id: number): string {
    switch (id) {
      case 1: return 'pending';
      case 2: return 'processing';
      case 3: return 'shipping';
      case 4: return 'pickup';
      case 5: return 'completed';
      case 6: return 'canceled';
      default: return 'pending';
    }
  }
}

