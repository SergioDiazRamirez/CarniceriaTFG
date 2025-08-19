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

  constructor(private http: HttpClient) {}

  getProducts(page = 1, search = '', categoryId: number | null = null): Observable<PaginatedResponse<Product>>  {
    let params = new HttpParams()
      .set('page', page.toString());

    if (search) params = params.set('search', search);
    if (categoryId) params = params.set('category_id', categoryId.toString());

    return this.http.get<PaginatedResponse<Product>>(this.baseUrl, { params });
  }
}
