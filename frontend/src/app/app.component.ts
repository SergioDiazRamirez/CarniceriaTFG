import { Component, Optional } from '@angular/core';
import { TranslateService } from '@ngx-translate/core';
import { WebNotificationService } from './services/web-notification.service';
import { IonRouterOutlet, NavController, Platform } from '@ionic/angular';
import { MobileNotificationService } from './services/mobile-notification.service';
import { Capacitor } from '@capacitor/core';
import { App } from '@capacitor/app';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss'],
  standalone: false,
})
export class AppComponent {
  constructor(private translate: TranslateService, private webNotifService: WebNotificationService,
    private platform: Platform, private mobileNotif: MobileNotificationService,
    private navCtrl: NavController,
    @Optional() private routerOutlet?: IonRouterOutlet
  ) {
    this.translate.addLangs(['es', 'en']);
    translate.setFallbackLang('es');
    this.translate.use('es');

     this.platform.backButton.subscribeWithPriority(10, () => {
          this.navCtrl.back();
        // Si hay un modal, alert o action sheet abierto lo cierra
        // if (this.routerOutlet && this.routerOutlet.canGoBack()) {
        //   this.navCtrl.back();
        // } else {
        //   // Salir de la app
        //   App.exitApp();
        // }
    });
    // this.enableBackButton();
  }

  ngOnInit() {
    this.mobileNotif.initPush(); // Notificaciones Android/iOS
    // if (Capacitor.isNativePlatform()) {
    //   this.mobileNotif.initPush(); 
    // } else { // Notificaciones web
    //   const token = this.webNotifService.requestPermission();
    //   this.webNotifService.listenMessages(); 
    // }
  }

  // enableBackButton() {
  //   this.platform.ready().then(() => {
  //     // Suscribirse al botón físico/virtual de Android
  //     this.platform.backButton.subscribeWithPriority(10, () => {
  //       // Si hay un modal, alert o action sheet abierto lo cierra
  //       if (this.routerOutlet && this.routerOutlet.canGoBack()) {
  //         this.navCtrl.back();
  //       } else {
  //         // Salir de la app
  //         App.exitApp();
  //       }
  //     });
  //   });
  // }

}
