import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Product } from 'src/app/models/product.model';
import { CartService } from 'src/app/services/cart.service';

@Component({
  selector: 'app-product-detail',
  templateUrl: './product-detail.page.html',
  styleUrls: ['./product-detail.page.scss'],
  standalone: false,
})
export class ProductDetailPage implements OnInit {
  product!: Product;
  weights = [0.250, 0.500, 1, 2]; // opciones de peso en gramos
  units = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
  selectedWeight?: number;
  selectedUnits?: number;

  constructor(
    private route: ActivatedRoute,
    private cartService: CartService,
    private http: HttpClient,
  ) { }

  ngOnInit() {
    if (history.state.product) {
      this.product = history.state.product;
    }
  }

 addToCart(product: Product) {
    switch (product.sale_type_id) {
      case 1: // Solo peso
        if (!this.selectedWeight) {
          console.warn('Debe seleccionar un peso');
          return;
        }
        this.cartService.addToCart(product, 1, this.selectedWeight);
        break;

      case 2: // Solo unidades
        if (!this.selectedUnits) {
          console.warn('Debe seleccionar unidades');
          return;
        }
        this.cartService.addToCart(product, this.selectedUnits);
        break;

      case 3: // Peso + unidades
        if (!this.selectedWeight || !this.selectedUnits) {
          console.warn('Debe seleccionar peso y unidades');
          return;
        }
        this.cartService.addToCart(product, this.selectedUnits, this.selectedWeight);
        break;
    }

    console.log(`${product.name} añadido al carrito`);
  }

  buyNow(product: any) {
    console.log('Comprar ahora', product, {
      weight: this.selectedWeight,
      units: this.selectedUnits
    });
  }
}

