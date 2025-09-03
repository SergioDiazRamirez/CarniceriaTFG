import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { OrderDetail } from 'src/app/models/order-detail.model';
import { OrderService } from 'src/app/services/order.service';

@Component({
  selector: 'app-order-detail',
  templateUrl: './order-detail.page.html',
  styleUrls: ['./order-detail.page.scss'],
  standalone: false
})
export class OrderDetailPage implements OnInit {
  orderDetail!: OrderDetail;
  orderId!: number;
  loading = false;

  constructor(private orderService: OrderService, private route: ActivatedRoute) { }

  ngOnInit() {
    this.orderId = +this.route.snapshot.paramMap.get('id')!; // Convierte el parámetro 'id' a número
    this.loadOrder(this.orderId);
  }

  ionViewWillEnter() {
    this.loadOrder(this.orderId);
  }
  
  loadOrder(id: number) {
    this.loading = true;
    this.orderService.getOrderDetail(id).subscribe({
      next: detail => {
        this.orderDetail = detail;
        this.loading = false;
      },
      error: () => this.loading = false
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
  
  cancelOrder(id: number) {
    //TODO: Implementar cancelación de pedido
  }
}
