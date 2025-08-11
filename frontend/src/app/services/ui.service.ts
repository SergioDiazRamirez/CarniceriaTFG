import { Injectable } from '@angular/core';
import { ToastController, AlertController } from '@ionic/angular';
import { TranslateService } from '@ngx-translate/core';

@Injectable({ 
  providedIn: 'root' 
})
export class UiService {

  constructor(
    private toastController: ToastController,
    private alertController: AlertController,
    private translate: TranslateService
  ) {}

  async showToast(messageKey: string, color: string = 'primary', duration: number = 3000, myPosition: any = 'bottom') {
    const toast = await this.toastController.create({
      message: this.translate.instant(messageKey),
      duration,
      color,
      position: myPosition
    });
    toast.present();
  }

  async showAlert(headerKey: string, messageKey: string) {
    const alert = await this.alertController.create({
      header: this.translate.instant(headerKey),
      message: this.translate.instant(messageKey),
      buttons: ['OK']
    });
    alert.present();
  }
}

