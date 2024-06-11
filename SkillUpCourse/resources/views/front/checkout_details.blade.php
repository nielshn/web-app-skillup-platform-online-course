@extends('layouts.frontend.main')
@section('title')
    Checkout Page
@endsection

@section('content')
    <div style="background-image: url('{{ asset('assets/background/Hero-Banner.png') }}')" id="hero-section"
        class="max-w-[1200px] mx-auto w-full flex flex-col gap-10 bg-center bg-no-repeat bg-cover rounded-[32px] overflow-hidden">
        @include('layouts.frontend.navbar')
    </div>
    <section id="Top-Categories" class="max-w-[1200px] mx-auto flex flex-col py-[70px] px-[100px] gap-[30px]">
        <div class="flex flex-col gap-[30px]">
            <!-- Transaksi User -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                @forelse ($transactions as $transaction)
                    <div class="item-card flex flex-row justify-between items-center">
                        <svg width="46" height="46" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
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
                        <div>
                            <p class="text-slate-500 text-sm">Total Amount</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $transaction->total_amount }}</h3>
                        </div>
                        <div>
                            <p class="text-slate-500 text-sm">Date</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $transaction->created_at }}</h3>
                        </div>
                        <div class="flex-col">
                            <p class="text-slate-500 text-sm">Status</p>
                            @if ($transaction->is_paid)
                                <span class="status-active text-white">ACTIVE</span>
                            @else
                                <span class="status-pending text-white">PENDING</span>
                            @endif
                        </div>
                        <div class="flex-row items-center gap-x-3">
                            <a href="{{ route('front.checkout_view_details', $transaction) }}"
                                class="py-4 px-6 view-details-btn">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <p>Belum ada transaksi terbaru</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
<style>
    .item-card {
        background-color: #F3F4F6;
        /* Warna latar belakang item card */
        padding: 20px;
        /* Padding untuk ruang di sekitar isi item card */
        border-radius: 20px;
        /* Sudut melingkar yang diperbarui untuk item card */
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        /* Shadow untuk efek angkat */
    }

    .status-active {
        background-color: #34D399;
        /* Warna latar belakang untuk status ACTIVE */
        color: #000000;
        /* Warna teks untuk status ACTIVE */
        padding: 4px 8px;
        /* Padding untuk ruang di dalam status */
        border-radius: 20px;
        /* Sudut melingkar yang diperbarui untuk status */
    }

    .status-pending {
        background-color: #FBBF24;
        /* Warna latar belakang untuk status PENDING */
        color: #000000;
        /* Warna teks untuk status PENDING */
        padding: 4px 8px;
        /* Padding untuk ruang di dalam status */
        border-radius: 20px;
        /* Sudut melingkar yang diperbarui untuk status */
    }

    .view-details-btn {
        background-color: #3525B3;
        /* Warna latar belakang untuk tombol View Details */
        color: #FFFFFF;
        /* Warna teks untuk tombol View Details */
        padding: 16px 24px;
        /* Padding tombol */
        border-radius: 30px;
        /* Sudut melingkar untuk tombol */
        text-decoration: none;
        /* Menghapus dekorasi teks */
        transition: background-color 0.3s ease;
        /* Transisi untuk animasi */
    }
</style>
