import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Product } from '../models/product.model';
import { environment } from 'src/environments/environment';
import { HttpParams } from '@angular/common/http';
import { PaginatedResponse } from '../models/paginatedResponse.model';

@Injectable({
  providedIn: 'root'
})
export class ProductService {
  private baseUrl = `${environment.apiUrl}/products`;

  constructor(private http: HttpClient) { }

  getProducts(page = 1, search = '', categoryId: number | null = null, favoritesOnly: string = ''): Observable<PaginatedResponse<Product>> {
    let params = new HttpParams()
      .set('page', page.toString());

    if (search) params = params.set('search', search);
    if (categoryId) params = params.set('category_id', categoryId.toString());
    if (favoritesOnly) params = params.set('favorites', favoritesOnly);
    
    return this.http.get<PaginatedResponse<Product>>(this.baseUrl, { params });
  }

  addFavorite(productId: number): Observable<any> {
    return this.http.post(`${environment.apiUrl}/favorites`, { product_id: productId });
  }

  removeFavorite(productId: number): Observable<any> {
    return this.http.delete(`${environment.apiUrl}/favorites/${productId}`);
  }

}
