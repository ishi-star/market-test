@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/address.css') }}">
@endsection

@section('content')
<div class="address-page">
    <h2 class="address-title">住所の変更</h2>

    <form action="{{ route('address.update', ['item_id' => $product->id]) }}" method="POST" class="address-form">
        @csrf
        <div class="form-group">
            <label>郵便番号</label>
            <input type="text" name="zip"  value="{{ old('zip', $profile->zip ?? '') }}">
        </div>

        <div class="form-group">
            <label>住所</label>
            <input type="text" name="address"  value="{{ old('address', $profile->address ?? '') }}">
        </div>

        <div class="form-group">
            <label>建物名</label>
            <input type="text" name="building"  value="{{ old('building', $profile->building ?? '') }}">
        </div>

        <div class="form-button">
            <button type="submit">更新する</button>
        </div>
    </form>
</div>
@endsection
