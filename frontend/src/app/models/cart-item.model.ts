import { Product } from './product.model';

export interface CartItem {
  product: Product;
  quantity: number;
  weight?: number;
  totalPrice: number;
}
