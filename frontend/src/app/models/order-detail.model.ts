import { Item } from "./item.model";

export interface OrderDetail {
  id: number;
  created_at: string;
  status_id: number;
  total_price: number;
  items: Item[];
  delivery_address?: string;
}