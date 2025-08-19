import { Category } from "./category.model";

export interface Product {
    id: number;
    name: string;
    ingredients?: string;
    description?: string;
    price: number;
    stock: number;
    image?: string;
    sale_type_id: number;
    categories: Category[];
    isFavorite?: boolean; //TODO: AÑADIR WHEIGHTS
}