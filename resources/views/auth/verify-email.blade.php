@extends('layouts.guest')

@section('content')
<style>
    .auth-page {
        min-height: 100vh;
        background: #0f1115;
    }

    .auth-left {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 60px 80px;
        min-height: 100vh;
        background: linear-gradient(135deg, #0f1115 0%, #131a22 100%);
    }

    .auth-card {
        width: 100%;
        max-width: 540px;
        background: rgba(22, 27, 34, 0.92);
        border: 1px solid #2a2f3a;
        border-radius: 20px;
        padding: 36px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
        color: #f8f9fa;
    }

    .auth-title {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .auth-subtitle {
        color: #aab2bd;
        margin-bottom: 28px;
        line-height: 1.7;
    }

    .auth-right {
        min-height: 100vh;
        background:
            linear-gradient(rgba(8, 10, 14, 0.35), rgba(8, 10, 14, 0.45)),
            url('/images/register-bg.jpeg') center center / cover no-repeat;
    }

    .auth-card .btn-primary,
    .auth-card .btn-outline-light,
    .auth-card .btn-outline-danger {
        border-radius: 12px;
        padding: 10px 18px;
    }

    @media (max-width: 991px) {
        .auth-right {
            display: none;
        }

        .auth-left {
            justify-content: center;
            padding: 30px 20px;
        }
    }
</style>

<div class="container-fluid auth-page">
    <div class="row g-0">
        <div class="col-lg-5 auth-left">
            <div class="auth-card">
                <h1 class="auth-title">Verify Your Email</h1>
                <p class="auth-subtitle">
                    Thanks for signing up. Before getting started, please verify your email address by clicking the link we just emailed to you.
                    If you didn’t receive the email, we can send you another one.
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="alert alert-success">
                        A new verification link has been sent to your email address.
                    </div>
                @endif

                <div class="d-flex flex-wrap gap-2">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Resend Verification Email</button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-7 auth-right"></div>
    </div>
</div>
@endsection
