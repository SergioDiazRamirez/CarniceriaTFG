import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';
import { Storage } from '@ionic/storage-angular';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private apiUrl = environment.apiUrl;
  private _storage: Storage | null = null;

  constructor(private http: HttpClient, private storage: Storage, private router: Router) {
    this.init();
  }
  // ------------- token ------------
  async init() {
    this._storage = await this.storage.create();
  }
  async setToken(token: string) {
    await this._storage?.set('access_token', token);
    localStorage.setItem('access_token', token); // Añadimos el token en localStorage también para que el interceptor pueda acceder al token de forma síncrona y añadirlo en la cabecera de las peticiones
  }
  async getToken(): Promise<string | null> {
    return await this._storage?.get('access_token');
  }
  async removeToken() {
    await this._storage?.remove('access_token');
  }
  //--------------------------------
  
  login(credentials: { email: string; password: string }): Observable<any> {
    return this.http.post(`${this.apiUrl}/login`, credentials);
  }

  isLoggedIn(): boolean {
    return !!localStorage.getItem('access_token');
  }

  async logout() {
    await this.removeToken();
    this.router.navigate(['/tabs/home']);
  }
}
