<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Cabin&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Knewave&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Actor&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link href="./css/main.css" rel="stylesheet" />
    <title>Document</title>
</head>

<body>
    <div class="v292_752">
        <div class="v292_753">
            <div class="v292_754"></div>
            <div class="v292_755"></div>
            <span class="v292_757">TRACKING ORDER</span>
        </div>
        <div class="v292_758">
            <div class="v292_759"></div>
            <span class="v292_760">ALMADA LAUNDRY</span>
            <div class="v292_761"></div>
            <a href="{{ route('home') }}"><span class="v292_762">HOME</span></a>
            <div class="v292_763"></div>
            <div class="v292_764"></div>
            <div class="v292_765"></div>
            <div class="v292_766"></div>
            <a href="{{ route('about') }}"><span class="v292_767">ABOUT US</span></a>
            <a href="{{ route('services') }}"><span class="v292_768">TRACKING ORDER</span></a>
            <a href="{{ route('pricing') }}"><span class="v292_769">PRICING</span></a>
            <span class="v292_770">CONTACT</span>
        </div>

        <!-- My Orders Section -->
        <div class="order-status-card">
            <h3>Orders</h3>

            <!-- Table Scrollable -->
            <div class="table-container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Laundry ID</th>
                            <th>Jenis</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->customer->name ?? '-' }}</td>
                            <td>{{ $order->laundry_id ?? '-' }}</td>
                            <td>{{ $order->jenis ?? '-' }}</td>
                            <td>{{ $order->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="v292_783">
            <div class="v292_784">
                <span class="v292_785">Get In Touch</span>
                <div class="v292_787"></div>
                <div class="v292_788"></div>
                <span class="v292_790">Phone +62 812345678</span>
                <div class="v292_791"></div>
                <span class="v292_792">Email almadalaundry@gmail.com</span>
                <span class="v292_793">Website www.almadalaundry.com</span>
                <span class="v292_794">Address Jl. Sampangan No.92, Semanggi, Kec. Ps. Kliwon, Kota Surakarta, Jawa Tengah 57191</span>
            </div>
            <div class="v292_796">
                <span class="v292_797">ALMADA LAUNDRY</span>
                <span class="v292_798">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                <div class="v292_800">
                    <div class="v292_801"></div>
                    <div class="v292_802"></div>
                </div>
            </div>
        </div>

        <div class="v349_324">
            <div class="v349_325"></div>
            <span class="v349_326">Phone +62 812345678</span>
            <span class="v349_327">Email almadalaundry@gmail.com</span>
            <div class="v349_328"></div>
            <div class="v349_329"></div>
            <a href="{{ route('login') }}">
                <div class="v349_331">
                    <div class="v349_332"></div><span class="v349_333">LOGIN</span>
                </div>
            </a>
            <a href="{{ route('register') }}">
                <div class="v349_334">
                    <div class="v349_335"></div><span class="v349_336">REGISTER</span>
                </div>
            </a>
        </div>
    </div>
</body>

</html>

    <style>
        /* Table wrapper agar bisa discroll */
        .table-container {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 20px;
        }

        /* Scrollbar style */
        .table-container::-webkit-scrollbar {
            width: 8px;
        }

        .table-container::-webkit-scrollbar-thumb {
            background-color: #888;
            border-radius: 8px;
        }

        .table-container::-webkit-scrollbar-thumb:hover {
            background-color: #555;
        }

        /* Styling tabel */
        table.table {
            width: 100%;
            background-color: white;
            border-collapse: collapse;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(78, 74, 74, 0.1);
        }

        table.table th,
        table.table td {
            padding: 12px 15px;
            text-align: center;
            font-family: 'Inter', sans-serif;
            border: 1px solid #ddd;
        }

        table.table th {
            background-color:rgb(113, 164, 201);
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 16px;
            border-top: 2px solid #333;
        }

        table.table td {
            background-color:rgb(255, 255, 255);
            color: #333;
            font-size: 14px;
        }

        table.table tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        table.table tr:hover td {
            background-color:rgb(255, 255, 255);
            cursor: pointer;
        }

        table.table td:nth-child(6) {
            color: #5293c2;
            font-weight: bold;
        }
    * {
        box-sizing: border-box;
    }

    body {
        font-size: 14px;
    }

    .v292_752 {
        width: 100%;
        height: 3359px;
        background: rgba(255, 255, 255, 1);
        opacity: 1;
        position: absolute;
        top: 0px;
        left: 0px;
        overflow: hidden;
    }

    .v292_753 {
        width: 100%;
        height: 190px;
        background: rgba(217, 231, 242, 1);
        opacity: 1;
        position: absolute;
        top: 194px;
        left: 0px;
        overflow: hidden;
    }

    .v292_754 {
        width: 100%;
        height: 198px;
        background: url("/storage/v292_754.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        opacity: 1;
        position: absolute;
        top: 0px;
        left: 0px;
        overflow: hidden;
    }

    .v292_755 {
        width: 100%;
        height: 190px;
        background: rgba(217, 231, 242, 1);
        opacity: 0.5;
        position: absolute;
        top: 0px;
        left: 0px;
        overflow: hidden;
    }

    .v292_756 {
        width: 173px;
        color: rgba(0, 72, 124, 1);
        position: absolute;
        top: 111px;
        left: 1008px;
        font-family: Cabin;
        font-weight: SemiBold;
        font-size: 24px;
        opacity: 1;
        text-align: center;
    }

    .v292_757 {
        width: 284px;
        color: rgba(0, 72, 124, 1);
        position: absolute;
        top: 33px;
        left: 941px;
        font-family: Cabin;
        font-weight: Bold;
        font-size: 64px;
        opacity: 1;
        text-align: center;
    }

    .v292_758 {
        width: 100%;
        height: 150px;
        background: url("/storage/v292_758.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        opacity: 1;
        position: absolute;
        top: 44px;
        left: 0px;
        overflow: hidden;
    }

    .v292_759 {
        width: 100%;
        height: 150px;
        background: rgba(255, 255, 255, 1);
        opacity: 1;
        position: absolute;
        top: 0px;
        left: 0px;
        overflow: hidden;
    }

    .v292_760 {
        width: 373px;
        color: rgba(0, 86, 149, 1);
        position: absolute;
        top: 37px;
        left: 55px;
        font-family: Knewave;
        font-weight: Regular;
        font-size: 48px;
        opacity: 1;
        text-align: left;
    }

    .v292_761 {
        width: 140px;
        height: 150px;
        background: rgba(255, 255, 255, 1);
        opacity: 1;
        position: absolute;
        top: 0px;
        left: 580px;
        overflow: hidden;
    }

    .v292_762 {
        width: 58px;
        color: rgba(0, 72, 124, 1);
        position: absolute;
        top: 63px;
        left: 621px;
        font-family: Actor;
        font-weight: Regular;
        font-size: 20px;
        opacity: 1;
        text-align: left;
    }

    .v292_763 {
        width: 140px;
        height: 150px;
        background: rgba(255, 255, 255, 1);
        opacity: 1;
        position: absolute;
        top: 0px;
        left: 720px;
        overflow: hidden;
    }

    .v292_764 {
        width: 140px;
        height: 150px;
        background: rgba(217, 231, 242, 1);
        opacity: 1;
        position: absolute;
        top: 0px;
        left: 860px;
        overflow: hidden;
    }

    .v292_765 {
        width: 140px;
        height: 150px;
        background: rgba(255, 255, 255, 1);
        opacity: 1;
        position: absolute;
        top: 0px;
        left: 1000px;
        overflow: hidden;
    }

    .v292_766 {
        width: 140px;
        height: 150px;
        background: rgba(255, 255, 255, 1);
        opacity: 1;
        position: absolute;
        top: 0px;
        left: 1140px;
        overflow: hidden;
    }

    .v292_767 {
        width: 94px;
        color: rgba(0, 72, 124, 1);
        position: absolute;
        top: 63px;
        left: 743px;
        font-family: Actor;
        font-weight: Regular;
        font-size: 20px;
        opacity: 1;
        text-align: left;
    }

    .v292_768 {
        width: 85px;
        color: rgba(0, 72, 124, 1);
        position: absolute;
        top: 63px;
        left: 887px;
        font-family: Actor;
        font-weight: Regular;
        font-size: 20px;
        opacity: 1;
        text-align: left;
    }

    .v292_769 {
        width: 73px;
        color: rgba(0, 72, 124, 1);
        position: absolute;
        top: 63px;
        left: 1033px;
        font-family: Actor;
        font-weight: Regular;
        font-size: 20px;
        opacity: 1;
        text-align: left;
    }

    .v292_770 {
        width: 86px;
        color: rgba(0, 72, 124, 1);
        position: absolute;
        top: 63px;
        left: 1167px;
        font-family: Actor;
        font-weight: Regular;
        font-size: 20px;
        opacity: 1;
        text-align: left;
    }

    .v292_783 {
        width: 100%;
        height: 445px;
        background: rgba(0, 72, 124, 1);
        opacity: 1;
        position: absolute;
        top: 2914px;
        left: 0px;
        overflow: hidden;
    }

    .v292_784 {
        width: 307px;
        height: 301px;
        background: url("/storage/v292_784.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        opacity: 1;
        position: absolute;
        top: 72px;
        left: 825px;
        overflow: hidden;
    }

    .v292_785 {
        width: 172px;
        color: rgba(255, 255, 255, 1);
        position: absolute;
        top: 21px;
        left: 18px;
        font-family: Cabin;
        font-weight: SemiBold;
        font-size: 32px;
        opacity: 1;
        text-align: center;
    }

    .name {
        color: #fff;
    }

    .v292_787 {
        width: 20px;
        height: 26px;
        background: rgba(255, 255, 255, 1);
        opacity: 1;
        position: absolute;
        top: 234px;
        left: 22px;
    }

    .v292_788 {
        width: 16px;
        height: 16px;
        background: url("/storage/v292_788.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        opacity: 1;
        position: absolute;
        top: 83px;
        left: 22px;
        overflow: hidden;
    }

    .name {
        color: #fff;
    }

    .v292_790 {
        width: 114px;
        color: rgba(176, 206, 227, 1);
        position: absolute;
        top: 75px;
        left: 56px;
        font-family: Inter;
        font-weight: Regular;
        font-size: 15px;
        opacity: 1;
        text-align: left;
    }

    .v292_791 {
        width: 26px;
        height: 20px;
        background: rgba(255, 255, 255, 1);
        opacity: 1;
        position: absolute;
        top: 128px;
        left: 21px;
    }

    .v292_792 {
        width: 191px;
        color: rgba(176, 206, 227, 1);
        position: absolute;
        top: 122px;
        left: 56px;
        font-family: Inter;
        font-weight: Regular;
        font-size: 15px;
        opacity: 1;
        text-align: left;
    }

    .v292_793 {
        width: 178px;
        color: rgba(176, 206, 227, 1);
        position: absolute;
        top: 169px;
        left: 56px;
        font-family: Inter;
        font-weight: Regular;
        font-size: 15px;
        opacity: 1;
        text-align: left;
    }

    .v292_794 {
        width: 239px;
        color: rgba(176, 206, 227, 1);
        position: absolute;
        top: 216px;
        left: 54px;
        font-family: Inter;
        font-weight: Regular;
        font-size: 15px;
        opacity: 1;
        text-align: left;
    }

    .name {
        color: #fff;
    }

    .v292_796 {
        width: 406px;
        height: 295px;
        background: url("/storage/v292_796.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        opacity: 1;
        position: absolute;
        top: 78px;
        left: 120px;
        overflow: hidden;
    }

    .v292_797 {
        width: 373px;
        color: rgba(255, 255, 255, 1);
        position: absolute;
        top: 13px;
        left: 13px;
        font-family: Knewave;
        font-weight: Regular;
        font-size: 48px;
        opacity: 1;
        text-align: left;
    }

    .v292_798 {
        width: 327px;
        color: rgba(255, 255, 255, 1);
        position: absolute;
        top: 102px;
        left: 36px;
        font-family: Cabin;
        font-weight: SemiBold;
        font-size: 20px;
        opacity: 1;
        text-align: center;
    }

    .name {
        color: #fff;
    }

    .v292_800 {
        width: 48px;
        height: 50px;
        background: url("/storage/v292_800.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        opacity: 1;
        position: absolute;
        top: 223px;
        left: 175px;
        overflow: hidden;
    }

    .v292_801 {
        width: 24px;
        height: 25px;
        background: url("/storage/v292_801.png");
        opacity: 1;
        position: absolute;
        top: 12px;
        left: 12px;
        border: 1.5px solid rgba(255, 255, 255, 1);
    }

    .v292_802 {
        width: 48px;
        height: 50px;
        background: url("/storage/v292_802.png");
        opacity: 1;
        position: absolute;
        top: 0px;
        left: 0px;
        border: 1.5px solid rgba(255, 255, 255, 1);
    }

    .name {
        color: #fff;
    }

    .v347_135 {
        width: 511px;
        height: 75px;
        background: url("/storage/v347_135.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        opacity: 1;
        position: absolute;
        top: 500px;
        left: 384px;
        overflow: hidden;
    }

    .v347_136 {
        width: 212px;
        color: rgba(0, 72, 124, 1);
        position: absolute;
        top: 0px;
        left: 150px;
        font-family: Cabin;
        font-weight: Bold;
        font-size: 36px;
        opacity: 1;
        text-align: center;
    }

    .v347_137 {
        width: 499px;
        color: rgba(0, 0, 0, 1);
        position: absolute;
        top: 51px;
        left: 6px;
        font-family: Cabin;
        font-weight: Regular;
        font-size: 20px;
        opacity: 1;
        text-align: center;
    }

    .v349_324 {
        width: 100%;
        height: 43px;
        background: url("/storage/v349_324.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        opacity: 1;
        position: absolute;
        top: 0px;
        left: 0px;
        overflow: hidden;
    }

    .v349_325 {
        width: 100%;
        height: 43px;
        background: rgba(0, 72, 124, 1);
        opacity: 1;
        position: absolute;
        top: 0px;
        left: 0px;
        overflow: hidden;
    }

    .v349_326 {
        width: 109px;
        color: rgba(176, 206, 227, 1);
        position: absolute;
        top: 12px;
        left: 81px;
        font-family: Inter;
        font-weight: Regular;
        font-size: 10px;
        opacity: 1;
        text-align: left;
    }

    .v349_327 {
        width: 155px;
        color: rgba(176, 206, 227, 1);
        position: absolute;
        top: 12px;
        left: 278px;
        font-family: Inter;
        font-weight: Regular;
        font-size: 10px;
        opacity: 1;
        text-align: left;
    }

    .v349_328 {
        width: 20px;
        height: 15px;
        background: rgba(255, 255, 255, 1);
        opacity: 1;
        position: absolute;
        top: 11px;
        left: 243px;
    }

    .v349_329 {
        width: 16px;
        height: 16px;
        background: url("/storage/v349_329.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        opacity: 1;
        position: absolute;
        top: 12px;
        left: 47px;
        overflow: hidden;
    }

    .name {
        color: #fff;
    }

    .v349_331 {
        width: 89px;
        height: 22px;
        background: url("/storage/v349_331.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        opacity: 1;
        position: absolute;
        top: 11px;
        left: 1061px;
        overflow: hidden;
    }

    .v349_332 {
        width: 89px;
        height: 22px;
        background: rgba(217, 231, 242, 1);
        opacity: 1;
        position: absolute;
        top: 0px;
        left: 0px;
        border-top-left-radius: 50px;
        border-top-right-radius: 50px;
        border-bottom-left-radius: 50px;
        border-bottom-right-radius: 50px;
        overflow: hidden;
    }

    .v349_333 {
        width: 51px;
        color: rgba(0, 72, 124, 1);
        position: absolute;
        top: 4px;
        left: 17px;
        font-family: Inter;
        font-weight: Bold;
        font-size: 16px;
        opacity: 1;
        text-align: center;
    }

    .v349_334 {
        width: 96px;
        height: 22px;
        background: url("/storage/v349_334.png");
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
        opacity: 1;
        position: absolute;
        top: 11px;
        left: 1165px;
        overflow: hidden;
    }

    .v349_335 {
        width: 96px;
        height: 22px;
        background: rgba(217, 231, 242, 1);
        opacity: 1;
        position: absolute;
        top: 0px;
        left: 0px;
        border-top-left-radius: 50px;
        border-top-right-radius: 50px;
        border-bottom-left-radius: 50px;
        border-bottom-right-radius: 50px;
        overflow: hidden;
    }

    .v349_336 {
        width: 79px;
        color: rgba(0, 72, 124, 1);
        position: absolute;
        top: 4px;
        left: 9px;
        font-family: Inter;
        font-weight: Bold;
        font-size: 16px;
        opacity: 1;
        text-align: center;
    }


.order-status-card {
    width: 80%;
    max-width: 1000px;
    margin: 400px auto 0;
    background-color: #f9f9f9;
    border-radius: 16px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    font-family: 'Inter', sans-serif;
}

.order-status-card h3 {
    font-size: 28px;
    color: #00487c;
    margin-bottom: 16px;
    text-align: center;
}

.order-box {
    border: 1px solid #ddd;
    border-radius: 12px;
    padding: 16px;
    background-color: #ffffff;
}

.order-header {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
}

.order-header h4 {
    margin: 0 0 8px;
    color: #00487c;
}

.order-progress {
    text-align: center;
}

.progress-bar {
    width: 120px;
    height: 10px;
    background-color: #eee;
    border-radius: 5px;
    margin-top: 8px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background-color: #007bff;
    border-radius: 5px 0 0 5px;
}

.order-estimate {
    text-align: center;
    color: #555;
}

.order-steps {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin: 24px 0;
    justify-content: space-between;
}

.step {
    flex: 1;
    min-width: 100px;
    padding: 8px;
    text-align: center;
    background-color: #d9e7f2;
    color: #00487c;
    border-radius: 8px;
    font-weight: 600;
}

.step.active {
    background-color: #007bff;
    color: #fff;
}

.pickup-button {
    text-align: center;
    margin: 16px 0;
}

.pickup-button button {
    background-color: #00487c;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
}

.minimize-text {
    text-align: center;
    color: #555;
    margin-top: 8px;
    font-size: 14px;
    cursor: pointer;
}

</style>



