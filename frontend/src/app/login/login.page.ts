import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
  standalone: false,
})
export class LoginPage implements OnInit {

  loginForm!: FormGroup
  constructor(private fb: FormBuilder, private authService: AuthService, private router: Router) { }

  ngOnInit() {
    this.loginForm = this.fb.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required],
    });
  }

  get email() {
    return this.loginForm.get('email');
  }
  get password() {
    return this.loginForm.get('password');
  }

  onSubmit() {
    // TODO: spiner de carga
    if (this.loginForm.invalid) {
      // TODO: Mostrar mensaje de error o feedback visual al usuario
      return;
    }
    this.authService.login(this.loginForm.value).subscribe({
      next: async (res) => {
        await this.authService.setToken(res.access_token);
        console.log('Login exitoso', res);
        this.router.navigateByUrl('/home');
      },
      error: (err) => {
        console.error('Error de login', err);
        // TODO: Mostrar mensaje de error al usuario
      }
    });
  }
}