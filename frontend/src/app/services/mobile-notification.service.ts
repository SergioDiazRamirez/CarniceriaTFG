import { Injectable } from '@angular/core';
import { PushNotifications } from '@capacitor/push-notifications';
import { UserService } from './user.service';

@Injectable({ providedIn: 'root' })
export class MobileNotificationService {
  constructor(private userService: UserService) {}

  async initPush() {
    let permStatus = await PushNotifications.checkPermissions();

    if (permStatus.receive !== 'granted') {
      permStatus = await PushNotifications.requestPermissions();
    }

    if (permStatus.receive === 'granted') {
      // Registrar para obtener el token
      await PushNotifications.register();
    }

    // Escuchar token
    PushNotifications.addListener('registration', async (token) => {
      console.log('Device FCM Token:', token.value);
      await this.userService.sendFcmToken(token.value);
    });

    // Escuchar notificaciones en foreground
    PushNotifications.addListener('pushNotificationReceived', (notification) => {
      console.log('Push recibido en foreground:', notification);
    });

    // Cuando el usuario toca la notificación
    PushNotifications.addListener('pushNotificationActionPerformed', (notification) => {
      console.log('Notificación tocada:', notification);
    });
  }
}
