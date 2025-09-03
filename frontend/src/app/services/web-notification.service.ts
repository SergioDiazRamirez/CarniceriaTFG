import { Injectable } from '@angular/core';
//import { AngularFireMessaging } from '@angular/fire/compat/messaging';
import { take } from 'rxjs/operators';
import { UserService } from './user.service';


@Injectable({ providedIn: 'root' })
export class WebNotificationService {
  // constructor(private afMessaging: AngularFireMessaging, private userService: UserService) {}

  // requestPermission() {
  //   this.afMessaging.requestToken
  //     .pipe(take(1))
  //     .subscribe({
  //       next: async (token) => {
  //         if(token) {
  //           console.log('FCM Web Token:', token)
  //           await this.userService.sendFcmToken(token)
  //         } else
  //           console.log('No se pudo obtener fcmToken')
  //       },
  //       error: (err) => console.error('Error obteniendo permiso', err),
  //     });
  // }

  // listenMessages() {
  //   this.afMessaging.messages.subscribe((payload) => {
  //     console.log('Notificación recibida en foreground (WEB):', payload);
  //     alert((payload as any).notification?.title);
  //   });
  // }
}
