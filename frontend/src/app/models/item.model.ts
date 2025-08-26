import { Product } from './product.model';

export interface Item {
  product: Product; // Usado para el carrito
  name?: string;
  quantity: number;
  weight?: number;
  total_price: number;
}
