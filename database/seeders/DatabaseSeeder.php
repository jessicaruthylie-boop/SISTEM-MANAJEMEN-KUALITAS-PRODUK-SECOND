<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. BUAT AKUN ADMINISTRATOR UTAMA
        $admin = User::updateOrCreate(
            ['email' => 'kelompok11pabi@gmail.com'],
            [
                'name' => 'Admin Utama SMK-BES',
                'password' => Hash::make('pabihebat'),
                'phone' => '080011223344',
                'nik' => '0000000000000000',
                'address' => 'HQ SMK-BES Jakarta',
                'post_code' => '10110',
                'role' => 'admin',
            ]
        );

        // 2. BUAT AKUN CUSTOMER (USER)
        $customers = [
            'Jessicaruth028@gmail.com' => 'Jessica Ruth',
            'Dionysius039@gmail.com' => 'Dionysius',
            'Christina056@gmail.com' => 'Christina'
        ];

        foreach ($customers as $email => $name) {
            User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => Hash::make('pabihebat'),
                    'phone' => '0812' . rand(1000, 9999),
                    'nik' => '3201' . rand(1000, 9999) . rand(1000, 9999),
                    'address' => 'Alamat Pengguna SMK-BES',
                    'post_code' => '12345',
                    'role' => 'customer',
                ]
            );
        }

        // 3. MASTER DATA TAKSONOMI (SELURUH DATA ANDA MASUK DISINI)
        $masterData = [
            'Smartphone' => [
                'Samsung' => ['Galaxy S20', 'Galaxy S21', 'Galaxy S22', 'Galaxy S23', 'Galaxy S24', 'Galaxy Note 10', 'Galaxy Note 20', 'Galaxy A10', 'Galaxy A20', 'Galaxy A30', 'Galaxy A50', 'Galaxy A54', 'Galaxy Z Flip 3', 'Galaxy Z Flip 4', 'Galaxy Z Fold 5'],
                'Apple (iPhone)' => ['iPhone 6', 'iPhone 6s', 'iPhone 7', 'iPhone 7 Plus', 'iPhone 8', 'iPhone 8 Plus', 'iPhone X', 'iPhone XR', 'iPhone XS', 'iPhone XS Max', 'iPhone 11', 'iPhone 11 Pro', 'iPhone 12', 'iPhone 13', 'iPhone 14'],
                'Xiaomi' => ['Xiaomi Mi 8', 'Xiaomi Mi 9', 'Xiaomi Mi 10', 'Xiaomi Mi 11', 'Xiaomi 12', 'Xiaomi 13', 'Xiaomi 14', 'Redmi Note 8', 'Redmi Note 9', 'Redmi Note 10', 'Redmi Note 11', 'Redmi Note 12', 'Redmi Note 13', 'POCO X3', 'POCO F3'],
                'Oppo' => ['OPPO A1', 'OPPO A3', 'OPPO A5', 'OPPO A7', 'OPPO A9', 'OPPO A12', 'OPPO A15', 'OPPO A31', 'OPPO A53', 'OPPO A54', 'OPPO A57', 'OPPO A74', 'OPPO Reno 5', 'OPPO Reno 6', 'OPPO Reno 7'],
                'Vivo' => ['Vivo Y11', 'Vivo Y12', 'Vivo Y15', 'Vivo Y17', 'Vivo Y20', 'Vivo Y21', 'Vivo Y30', 'Vivo Y51', 'Vivo V15', 'Vivo V17', 'Vivo V20', 'Vivo V21', 'Vivo X50', 'Vivo X60', 'Vivo X70'],
                'Realme' => ['Realme 3', 'Realme 5', 'Realme 6', 'Realme 7', 'Realme 8', 'Realme 9', 'Realme C2', 'Realme C3', 'Realme C11', 'Realme C15', 'Realme C25', 'Realme Narzo 20', 'Realme GT', 'Realme GT Neo 2', 'Realme X2 Pro'],
                'Huawei' => ['Huawei P20', 'Huawei P30', 'Huawei P40', 'Huawei P50', 'Huawei P60', 'Huawei Mate 10', 'Huawei Mate 20', 'Huawei Mate 30', 'Huawei Mate 40', 'Huawei Mate 50', 'Huawei Nova 3', 'Huawei Nova 5', 'Huawei Nova 7', 'Huawei Nova 9', 'Huawei Nova 11'],
                'OnePlus' => ['OnePlus 5', 'OnePlus 5T', 'OnePlus 6', 'OnePlus 6T', 'OnePlus 7', 'OnePlus 7 Pro', 'OnePlus 8', 'OnePlus 8 Pro', 'OnePlus 9', 'OnePlus 9 Pro', 'OnePlus 10 Pro', 'OnePlus 11', 'OnePlus Nord', 'OnePlus Nord 2', 'OnePlus Nord CE'],
                'Nokia' => ['Nokia 1.3', 'Nokia 2.4', 'Nokia 3.4', 'Nokia 5.4', 'Nokia 6.2', 'Nokia 7.2', 'Nokia 8.3', 'Nokia C1', 'Nokia C2', 'Nokia C3', 'Nokia G10', 'Nokia G20', 'Nokia X10', 'Nokia X20', 'Nokia XR20'],
                'Asus (ROG / Zenfone)' => ['ASUS Zenfone 3', 'ASUS Zenfone 4', 'ASUS Zenfone 5', 'ASUS Zenfone 6', 'ASUS Zenfone 7', 'ASUS Zenfone 8', 'ASUS Zenfone 9', 'ASUS ROG Phone', 'ROG Phone 2', 'ROG Phone 3', 'ROG Phone 5', 'ROG Phone 6', 'ROG Phone 7', 'ASUS Max Pro M1', 'ASUS Max Pro M2'],
                'LG' => ['LG G3', 'LG G4', 'LG G5', 'LG G6', 'LG G7', 'LG V10', 'LG V20', 'LG V30', 'LG V40', 'LG V50', 'LG Q6', 'LG Q7', 'LG Q9', 'LG Velvet', 'LG Wing'],
                'Infinix' => ['Infinix Hot 6', 'Infinix Hot 7', 'Infinix Hot 8', 'Infinix Hot 9', 'Infinix Hot 10', 'Infinix Hot 11', 'Infinix Hot 12', 'Infinix Note 7', 'Infinix Note 8', 'Infinix Note 10', 'Infinix Note 11', 'Infinix Note 12', 'Infinix Zero 8', 'Infinix Zero X', 'Infinix Smart 5'],
                'Tecno' => ['Tecno Spark 5', 'Tecno Spark 6', 'Tecno Spark 7', 'Tecno Spark 8', 'Tecno Spark 9', 'Tecno Spark 10', 'Tecno Camon 12', 'Tecno Camon 15', 'Tecno Camon 16', 'Tecno Camon 17', 'Tecno Camon 18', 'Tecno Phantom 8', 'Tecno Phantom X', 'Tecno Pova', 'Tecno Pova 2'],
                'itel' => ['Itel A16', 'Itel A23', 'Itel A25', 'Itel A26', 'Itel A27', 'Itel S13', 'Itel S15', 'Itel S16', 'Itel S17', 'Itel P32', 'Itel P33', 'Itel P36', 'Itel Vision 1', 'Itel Vision 2', 'Itel Vision 3']
            ],
            'Laptop' => [
                'MacBook (Apple)' => ['MacBook Air M1', 'MacBook Air M2', 'MacBook Air M3', 'MacBook Pro 13"', 'MacBook Pro 14"', 'MacBook Pro 16"', 'MacBook Retina 12"', 'MacBook Pro M1', 'MacBook Pro M2', 'MacBook Pro M3', 'MacBook Air 2018', 'MacBook Air 2019', 'MacBook Air 2020', 'MacBook Pro Touch Bar', 'MacBook Pro Retina'],
                'ASUS' => ['ASUS VivoBook 14', 'ASUS VivoBook 15', 'ASUS ZenBook 13', 'ASUS ZenBook 14', 'ASUS ZenBook Pro', 'ASUS ROG Strix', 'ASUS ROG Zephyrus', 'ASUS TUF Gaming F15', 'ASUS TUF Gaming A15', 'ASUS ExpertBook', 'ASUS ProArt StudioBook', 'ASUS Chromebook Flip', 'ASUS X441', 'ASUS X515', 'ASUS E410'],
                'Lenovo' => ['Lenovo ThinkPad X1 Carbon', 'Lenovo ThinkPad T14', 'Lenovo ThinkBook 14', 'Lenovo IdeaPad 3', 'Lenovo IdeaPad 5', 'Lenovo IdeaPad Gaming 3', 'Lenovo Legion 5', 'Lenovo Legion 7', 'Lenovo Yoga Slim 7', 'Lenovo Yoga C740', 'Lenovo Flex 5', 'Lenovo Chromebook Duet', 'Lenovo V14', 'Lenovo V15', 'Lenovo LOQ'],
                'HP' => ['HP Pavilion 14', 'HP Pavilion 15', 'HP Envy 13', 'HP Envy x360', 'HP Spectre x360', 'HP Omen 15', 'HP Victus 15', 'HP ProBook 440', 'HP EliteBook 840', 'HP Chromebook 14', 'HP Stream 11', 'HP ZBook', 'HP 14s', 'HP 15s', 'HP Omen Transcend'],
                'Dell' => ['Dell XPS 13', 'Dell XPS 15', 'Dell Inspiron 14', 'Dell Inspiron 15', 'Dell Vostro 14', 'Dell Vostro 15', 'Dell Latitude 5420', 'Dell Precision 5550', 'Dell G3', 'Dell G5', 'Alienware M15', 'Alienware X17', 'Dell Chromebook 3100', 'Dell Studio', 'Dell OptiPlex Laptop'],
                'Acer' => ['Acer Aspire 3', 'Acer Aspire 5', 'Acer Swift 3', 'Acer Swift 5', 'Acer Nitro 5', 'Acer Predator Helios 300', 'Acer Chromebook 314', 'Acer Spin 3', 'Acer Spin 5', 'Acer TravelMate P2', 'Acer TravelMate P4', 'Acer Enduro N3', 'Acer ConceptD 7', 'Acer Extensa 15', 'Acer Aspire E5'],
                'MSI' => ['MSI GF63 Thin', 'MSI GF65 Thin', 'MSI Katana GF66', 'MSI Bravo 15', 'MSI Modern 14', 'MSI Prestige 14', 'MSI Summit E13', 'MSI Stealth 15M', 'MSI Raider GE66', 'MSI Titan GT77', 'MSI Sword 15', 'MSI Creator Z16', 'MSI Pulse GL66', 'MSI Alpha 15', 'MSI Cyborg 15'],
                'Axioo' => ['Axioo MyBook 14', 'Axioo MyBook 14F', 'Axioo MyBook 15', 'Axioo MyBook Pro', 'Axioo Pongo 960', 'Axioo Pongo 960P', 'Axioo Pongo 725', 'Axioo Pongo 750', 'Axioo Neon', 'Axioo Windroid', 'Axioo Slimbook', 'Axioo Hype 3', 'Axioo Hype 5', 'Axioo Zetta', 'Axioo C14']
            ],
            'Komputer / PC' => [
                'Dell' => ['OptiPlex 3000', 'OptiPlex 5000', 'OptiPlex 7000', 'Vostro 3681', 'Vostro 3888', 'Inspiron 3881', 'Inspiron 3891', 'XPS 8940', 'XPS 8960', 'Alienware Aurora R10', 'Alienware Aurora R12', 'Precision 3640', 'Precision 3650', 'PowerEdge T40', 'PowerEdge T150'],
                'HP' => ['Pavilion TP01', 'Pavilion TG01', 'Envy TE01', 'Omen 25L', 'Omen 30L', 'ProDesk 400 G6', 'ProDesk 600 G6', 'EliteDesk 800 G6', 'EliteDesk 805 G8', 'Z2 Tower G5', 'Z4 G4', 'Slimline 290', 'Victus 15L', 'Chromebase', 'All-in-One 24'],
                'Lenovo' => ['ThinkCentre M70t', 'ThinkCentre M80t', 'ThinkCentre M90t', 'IdeaCentre 3', 'IdeaCentre 5', 'Legion Tower 5', 'Legion Tower 7i', 'ThinkStation P330', 'ThinkStation P340', 'ThinkServer TS140', 'ThinkServer TS150', 'ThinkCentre Neo 30a', 'IdeaCentre AIO 3', 'IdeaCentre AIO 5', 'ThinkCentre Tiny M90q'],
                'ASUS' => ['ROG Strix GT15', 'ROG Strix GL10', 'ROG Huracan', 'TUF Gaming GT301', 'ExpertCenter D5', 'ExpertCenter D7', 'VivoPC X', 'ProArt Station PD5', 'Mini PC PN62', 'Mini PC PN64', 'ROG G20', 'ROG G35', 'TUF Gaming VG30', 'ASUS S500MC', 'ASUS S340MC'],
                'Acer' => ['Aspire TC-895', 'Aspire XC-1660', 'Veriton M200', 'Veriton X4670G', 'Predator Orion 3000', 'Predator Orion 5000', 'Nitro N50', 'Nitro N60', 'Chromebox CXI3', 'Aspire C22 AIO', 'Aspire C24 AIO', 'ConceptD 500', 'ConceptD 900', 'Veriton Z All-in-One', 'TravelMate Desktop'],
                'Apple' => ['iMac 21.5"', 'iMac 24" M1', 'iMac 27" Retina', 'iMac Pro', 'Mac mini M1', 'Mac mini M2', 'Mac Studio M1 Max', 'Mac Studio M2 Ultra', 'Mac Pro 2019', 'Mac Pro 2023', 'iMac M3', 'Mac mini Intel', 'iMac Late 2015', 'iMac Late 2017', 'Mac Studio 2024'],
                'MSI' => ['MSI Aegis R', 'MSI Aegis Ti5', 'MSI Trident 3', 'MSI Infinite S', 'MSI Codex R', 'MSI MAG Infinite S', 'MSI Creator P100X', 'MSI Nightblade MI3', 'MSI Cubi 5', 'MSI Cubi N', 'MSI Pro DP20Z', 'MSI Pro DP21', 'MSI MEG Trident X', 'MSI MPG Infinite', 'MSI Vortex G65'],
                'Samsung' => ['Samsung DP300A2A', 'Samsung Series 3 Desktop', 'Samsung syncmaster'],
                'Toshiba' => ['Dynabook DX100', 'Satellite Desktop', 'Portege Desktop'],
                'Fujitsu' => ['Esprimo D556', 'Celsius W580', 'Lifebook Desktop']
            ],
            'Tablet' => [
                'Apple iPad' => ['iPad 2', 'iPad 5th Gen', 'iPad 10th Gen', 'iPad Air 4', 'iPad Mini 5', 'iPad Pro 12.9”'],
                'Samsung Galaxy Tab' => ['Galaxy Tab A', 'Galaxy Tab A9', 'Galaxy Tab S6', 'Galaxy Tab S9', 'Galaxy Tab E'],
                'Xiaomi / Redmi Pad' => ['Xiaomi Mi Pad 5', 'Redmi Pad SE', 'Xiaomi Pad 6 Pro'],
                'Huawei MatePad' => ['Huawei MatePad 11', 'Huawei MatePad Pro', 'MatePad SE'],
                'Lenovo Tab' => ['Lenovo Tab M10', 'Lenovo Tab P11', 'Yoga Tab 11'],
                'ASUS Tablet' => ['ZenPad 10', 'Transformer Mini', 'ROG Flow Z13'],
                'Microsoft Surface' => ['Surface Pro 7', 'Surface Pro 8', 'Surface Go 3'],
                'Realme Pad' => ['Realme Pad Mini', 'Realme Pad X'],
                'OPPO Pad' => ['OPPO Pad Air', 'OPPO Pad 2'],
                'Amazon Fire' => ['Fire HD 8', 'Fire HD 10']
            ],
            'Televisi (TV)' => [
                'Samsung TV' => ['Samsung Q60', 'Samsung Q90', 'Samsung AU7000', 'The Frame', 'The Serif'],
                'LG TV' => ['LG UHD AI ThinQ', 'LG OLED C2', 'LG QNED90', 'LG NanoCell 85'],
                'Sony Bravia' => ['Sony Bravia X80', 'Sony Bravia A80 OLED', 'Bravia XR Series'],
                'TCL TV' => ['TCL P725', 'TCL C725', 'TCL Mini-LED', 'Android TV'],
                'Panasonic TV' => ['Panasonic Viera', 'Panasonic JX900', 'Panasonic LZ1000'],
                'Sharp TV' => ['Sharp Aquos 4T', 'Sharp Android TV', 'Sharp OLED TV'],
                'Hisense TV' => ['Hisense A6', 'Hisense U8', 'Laser TV'],
                'Philips TV' => ['Philips 7000 Series', 'Ambilight TV'],
                'Xiaomi TV' => ['Mi TV 4A', 'Mi TV P1', 'Xiaomi TV A2'],
                'Polytron TV' => ['Polytron PLD', 'Cinemax Soundbar', 'Polytron 4K UHD']
            ],
            'Kulkas' => [
                'LG Refrigerator' => ['LG GN-B185', 'LG InstaView', 'LG Side by Side'],
                'Samsung Refrigerator' => ['Samsung RT19', 'Samsung Bespoke', 'Samsung Family Hub'],
                'Sharp Refrigerator' => ['Sharp SJ-195MD', 'Sharp Plasmacluster', 'Sharp J-Tech Inverter'],
                'Panasonic Refrigerator' => ['Panasonic NR-BB211', 'Panasonic Econavi', 'Panasonic Prime Fresh'],
                'Toshiba Refrigerator' => ['Toshiba GR-B175', 'Toshiba Origin Inverter'],
                'AQUA' => ['Aqua AQR-D180', 'Aqua Japan Series'],
                'Polytron Refrigerator' => ['Polytron Belleza', 'Polytron PRO Series'],
                'Electrolux Refrigerator' => ['Electrolux NutriFresh', 'Electrolux French Door'],
                'Hitachi Refrigerator' => ['Hitachi Inverter X', 'Hitachi Side by Side'],
                'Mitsubishi Electric' => ['Mitsubishi MR-FC', 'Mitsubishi Neuro Inverter']
            ],
            'Mesin Cuci' => [
                'LG Washing Machine' => ['LG Smart Inverter', 'LG AI DD', 'LG TwinWash'],
                'Samsung Washing Machine' => ['Samsung EcoBubble', 'Samsung QuickDrive', 'Samsung AddWash'],
                'Sharp Washing Machine' => ['Sharp Megamouth', 'Sharp Dolphinwave', 'Sharp Eco Wash'],
                'Panasonic Washing Machine' => ['Panasonic Econavi', 'Panasonic StainMaster'],
                'Toshiba Washing Machine' => ['Toshiba GreatWaves', 'Toshiba Real Inverter'],
                'AQUA Washing Machine' => ['Aqua Japan Technology', 'Aqua Hijab Series'],
                'Polytron Washing Machine' => ['Polytron PWM 705', 'Polytron Zeromatic'],
                'Electrolux Washing Machine' => ['Electrolux UltimateCare', 'Electrolux Vapour Care'],
                'Hitachi Washing Machine' => ['Hitachi Big Drum', 'Hitachi Auto Dosing'],
                'Mitsubishi Washing Machine' => ['Mitsubishi Diamond Drum', 'Mitsubishi Inverter Series']
            ],
            'AC (Air Conditioner)' => [
                'Daikin AC' => ['Daikin FTKC Series', 'Daikin FTNE Series', 'Daikin Urusara 7'],
                'Panasonic AC' => ['Panasonic CS-PN Series', 'Panasonic Nanoe-X'],
                'LG AC' => ['LG Dual Inverter', 'LG Artcool', 'LG DUALCOOL'],
                'Samsung AC' => ['Samsung Wind-Free', 'Samsung Digital Inverter'],
                'Sharp AC' => ['Sharp AH-X Series', 'Sharp Plasmacluster'],
                'Mitsubishi Electric AC' => ['Mitsubishi Mr. Slim', 'Mitsubishi Heavy Duty'],
                'Gree AC' => ['Gree GWC Series', 'Gree Lomo Series'],
                'Hitachi AC' => ['Hitachi Standard Series', 'Hitachi iClean'],
                'TCL AC' => ['TCL TAC Series', 'TCL Gentle Breeze'],
                'Polytron AC' => ['Polytron Neuva Ice', 'Polytron Smart Series']
            ],
            'Kipas Angin' => [
                'Cosmos' => ['Cosmos 16-XDA', 'Cosmos Stand Fan', 'Cosmos Tornado'],
                'Miyako' => ['Miyako KAS-1606', 'Miyako Desk Fan'],
                'Maspion' => ['Maspion PW-1200', 'Maspion Ceiling Fan'],
                'Panasonic' => ['Panasonic F-EP401', 'Panasonic Air Circulator'],
                'Sharp' => ['Sharp PJ-A26', 'Sharp Remote Fan'],
                'KDK' => ['KDK M40A', 'KDK Ceiling Fan'],
                'Sekai' => ['Sekai SFN-1620', 'Sekai Industrial Fan'],
                'Sanken' => ['Sanken SF-1610', 'Sanken SF-1800'],
                'Arashi' => ['Arashi A-1601', 'Arashi Tower Fan'],
                'Advance' => ['Advance USB Fan', 'Advance Quiet Fan']
            ],
            'Speaker' => [
                'JBL' => ['JBL Flip', 'JBL Charge', 'JBL PartyBox', 'JBL Bar (Soundbar)'],
                'Sony Audio' => ['Sony SRS-XB Series', 'Sony HT Series'],
                'Bose' => ['Bose SoundLink', 'Bose Smart Soundbar', 'Bose S1 Pro'],
                'Samsung Audio' => ['Samsung HW Series', 'Samsung Sound Tower'],
                'Harman Kardon' => ['Onyx Studio', 'Aura Studio', 'Citation Series'],
                'Logitech Audio' => ['Z213', 'Z623', 'Z906'],
                'Marshall' => ['Acton', 'Stanmore', 'Emberton'],
                'Polytron Audio' => ['PAS Series', 'PMA Series'],
                'Edifier' => ['R1280', 'R1700', 'Edifier AirPulse'],
                'Xiaomi Audio' => ['Mi Bluetooth Speaker', 'Mi Soundbar'],
                'Sony Ericsson' => ['Portable Speaker', 'Home Speaker'],
                'Ultimate Ears' => ['UE Boom', 'UE Wonderboom']
            ],
            'Headphone' => [
                'Sony' => ['WH-1000XM', 'MDR-7506', 'LinkBuds'],
                'Bose' => ['QuietComfort (QC)', 'Bose 700'],
                'Sennheiser' => ['HD 600 Series', 'Momentum'],
                'JBL' => ['JBL Tune', 'JBL Quantum (Gaming)'],
                'Audio-Technica' => ['ATH-M Series', 'ATH-AD Series'],
                'Beats by Apple' => ['Beats Studio', 'Beats Solo'],
                'HyperX' => ['Cloud II', 'Cloud Alpha'],
                'Razer' => ['Razer Kraken', 'BlackShark'],
                'Apple' => ['AirPods Max'],
                'Philips' => ['SHP Series', 'Fidelio']
            ],
            'Earphone' => [
                'Sony' => ['Sony MDR-EX', 'WF-1000XM'],
                'JBL' => ['JBL Tune', 'JBL Endurance'],
                'Xiaomi' => ['Mi Basic Earbuds', 'Redmi Buds'],
                'Samsung' => ['Galaxy Buds Pro', 'Galaxy Buds 2'],
                'Razer' => ['Hammerhead', 'Moray'],
                'Apple' => ['EarPods', 'AirPods Pro'],
                'Sennheiser' => ['CX Series', 'IE Series'],
                'Philips' => ['SHE Series', 'TAT True Wireless'],
                'QCY' => ['QCY T Series', 'QCY HT Series'],
                'Realme' => ['Realme Buds Air', 'Realme Buds Neo']
            ]
        ];

        $grades = ['A', 'B', 'C', 'D'];
        $locations = ['Jakarta Pusat', 'Bekasi', 'Tangerang', 'Surabaya', 'Bandung', 'Medan', 'Semarang', 'Makassar'];

        // 4. LOOPING MASIF: 10 UNIT PER MODEL (TOTAL RIBUAN DATA)
        foreach ($masterData as $category => $brands) {
            foreach ($brands as $brand => $models) {
                foreach ($models as $modelName) {
                    
                    for ($i = 1; $i <= 10; $i++) {
                        $grade = $grades[array_rand($grades)];
                        
                        Product::create([
                            'user_id' => $admin->id, // Audit: Diinput oleh Admin Kelompok 11
                            'category' => $category,
                            'brand' => $brand,
                            'model' => $modelName . " - Unit " . $i,
                            'description' => "Unit seken berkualitas tinggi kategori $category. Telah lulus inspeksi teknis SMK-BES. Kondisi fisik sesuai Grade $grade. Fungsi normal 100%.",
                            'grade' => $grade,
                            'location' => $locations[array_rand($locations)],
                            'stock' => rand(1, 5),
                            'price' => $this->generatePrice($category),
                            'image' => 'https://dummyimage.com/600x600/1e293b/fff&text=' . urlencode($modelName),
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Helper Logika Harga Berdasarkan Kategori
     */
    private function generatePrice($category)
    {
        return match ($category) {
            'Smartphone' => rand(1500000, 18000000),
            'Laptop' => rand(3500000, 35000000),
            'Komputer / PC' => rand(4000000, 45000000),
            'Tablet' => rand(2000000, 20000000),
            'Televisi (TV)' => rand(1500000, 25000000),
            'Kulkas' => rand(1500000, 15000000),
            'Mesin Cuci' => rand(1500000, 10000000),
            'AC (Air Conditioner)' => rand(2500000, 8000000),
            'Kipas Angin' => rand(200000, 1500000),
            'Speaker' => rand(500000, 10000000),
            'Headphone', 'Earphone' => rand(300000, 6000000),
            default => rand(500000, 5000000),
        };
    }
}