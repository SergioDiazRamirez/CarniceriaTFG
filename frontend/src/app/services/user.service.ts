import { Injectable } from '@angular/core';
import { User } from '../models/user.model';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';
import { Observable } from 'rxjs';
import { firstValueFrom } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private baseUrl = `${environment.apiUrl}/user`

  constructor(private http: HttpClient) { }

  getUser() {
    return this.http.get<User>(`${this.baseUrl}/index`);
  }

  updateUser(user: Partial<User>): Observable<any> {
    return this.http.put(`${this.baseUrl}/update`, user);
  }

  changePassword(data: { current_password: string; new_password: string; new_password_confirmation: string }): Observable<any> {
    return this.http.put(`${this.baseUrl}/password`, data);
  }
  deleteAccount(): Observable<any> {
    return this.http.delete(`${this.baseUrl}`);
  }

  async sendFcmToken(fcmToken: string) {
    return await firstValueFrom(this.http.post(`${this.baseUrl}/saveFcmToken`,{token: fcmToken}));
  }
  sendNotification(): Observable<any> {
    console.log("notificacion");
    return this.http.get(`${this.baseUrl}/notification`)
  }
}
