@extends('layouts.frontend.main')
@section('title')
    Checkout Details
@endsection

@section('content')
    <div style="background-image: url('{{ asset('assets/background/Hero-Banner.png') }}')" id="hero-section"
        class="max-w-[1200px] mx-auto w-full flex flex-col gap-10 bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden">
        @include('layouts.frontend.navbar')
    </div>
    <section id="Top-Categories" class="max-w-[1200px] mx-auto flex flex-col py-[70px] px-[100px] gap-[30px]">
        <div class="flex flex-col gap-[30px]">
            <div class="card">
                <div class="item-container">
                    <svg width="100" height="100" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4"
                            d="M19 10.2798V17.4298C18.97 20.2798 18.19 20.9998 15.22 20.9998H5.78003C2.76003 20.9998 2 20.2498 2 17.2698V10.2798C2 7.5798 2.63 6.7098 5 6.5698C5.24 6.5598 5.50003 6.5498 5.78003 6.5498H15.22C18.24 6.5498 19 7.2998 19 10.2798Z"
                            fill="#292D32" />
                        <path
                            d="M22 6.73V13.72C22 16.42 21.37 17.29 19 17.43V10.28C19 7.3 18.24 6.55 15.22 6.55H5.78003C5.50003 6.55 5.24 6.56 5 6.57C5.03 3.72 5.81003 3 8.78003 3H18.22C21.24 3 22 3.75 22 6.73Z"
                            fill="#292D32" />
                        <path
                            d="M6.96027 18.5601H5.24023C4.83023 18.5601 4.49023 18.2201 4.49023 17.8101C4.49023 17.4001 4.83023 17.0601 5.24023 17.0601H6.96027C7.37027 17.0601 7.71027 17.4001 7.71027 17.8101C7.71027 18.2201 7.38027 18.5601 6.96027 18.5601Z"
                            fill="#292D32" />
                        <path
                            d="M12.5494 18.5601H9.10938C8.69938 18.5601 8.35938 18.2201 8.35938 17.8101C8.35938 17.4001 8.69938 17.0601 9.10938 17.0601H12.5494C12.9594 17.0601 13.2994 17.4001 13.2994 17.8101C13.2994 18.2201 12.9694 18.5601 12.5494 18.5601Z"
                            fill="#292D32" />
                        <path d="M19 11.8599H2V13.3599H19V11.8599Z" fill="#292D32" />
                    </svg>
                    <div class="item-details">
                        <div>
                            <p class="text-slate-500 text-sm">Total Amount</p>
                            <h3 class="text-indigo-950 text-xl font-bold">Rp {{ $transactions->total_amount }}</h3>
                        </div>
                        @if ($transactions->is_paid)
                            <span class="status-badge active-badge">ACTIVE</span>
                        @else
                            <span class="status-badge pending-badge">PENDING</span>
                        @endif
                        <div>
                            <p class="text-slate-500 text-sm">Checkout Date</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $transactions->created_at }}</h3>
                        </div>
                        <div>
                            <p class="text-slate-500 text-sm">Subscription Start At</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $transactions->subscription_start_date }}</h3>
                        </div>
                    </div>
                    <div>
                        <img src="{{ Storage::url($transactions->proof) }}" alt="Proof of transaction">
                    </div>
                </div>
                <hr class="my-5">
                <button id="exportButton" class="export-btn"
                    onclick="window.location.href='{{ route('export.pdf', ['transaction' => $transactions->id]) }}'">Export
                    to PDF</button>
            </div>
        </div>
    </section>
@endsection
<style>
    #Top-Categories {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        padding: 70px 100px;
        gap: 30px;
    }

    .card {
        background-color: white;
        overflow-hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 20px;
        margin: 0 auto;
        width: 100%;
        max-width: 600px;
    }

    .item-container {
        display: flex;
        flex-direction: row;
        gap: 20px;
        align-items: center;
    }

    .item-container img {
        max-width: 200px;
        height: auto;
        border-radius: 10px;
    }

    .item-details {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .status-badge {
        padding: 4px 8px;
        border-radius: 20px;
        color: #FFFFFF;
        font-size: 12px;
        font-weight: bold;
        align-self: flex-start;
    }

    .active-badge {
        background-color: #34D399;
    }

    .pending-badge {
        background-color: #FBBF24;
    }

    .item-details p {
        margin: 0;
        font-size: 14px;
        color: #718096;
    }

    .item-details h3 {
        margin: 0;
        font-size: 20px;
        color: #4A5568;
        font-weight: bold;
    }

    .flex.flex-col.gap-\[30px\] {
        display: flex;
        flex-direction: column;
        gap: 30px;
        align-items: center;
    }

    .export-btn {
        background-color: #4A5568;
        color: #FFFFFF;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        font-weight: bold;
        align-self: flex-end;
        /* Menempatkan tombol di kanan bawah card */
    }

    .export-btn:hover {
        background-color: #2D3748;
    }
</style>
