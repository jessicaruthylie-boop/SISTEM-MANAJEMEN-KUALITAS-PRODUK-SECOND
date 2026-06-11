<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // Asumsikan ada user default

        $categories = [
            'Smartphone' => [
                ['brand' => 'Samsung', 'models' => ['Galaxy S20', 'Galaxy S21', 'Galaxy S22', 'Galaxy S23', 'Galaxy S24', 'Galaxy Note 10', 'Galaxy Note 20', 'Galaxy A10', 'Galaxy A20', 'Galaxy A30']],
                ['brand' => 'Apple (iPhone)', 'models' => ['iPhone 6', 'iPhone 6s', 'iPhone 7', 'iPhone 7 Plus', 'iPhone 8', 'iPhone 8 Plus', 'iPhone X', 'iPhone XR', 'iPhone XS', 'iPhone XS Max']],
                ['brand' => 'Xiaomi', 'models' => ['Xiaomi Mi 8', 'Xiaomi Mi 9', 'Xiaomi Mi 10', 'Xiaomi Mi 11', 'Xiaomi 12', 'Xiaomi 13', 'Xiaomi 14', 'Redmi Note 8', 'Redmi Note 9', 'Redmi Note 10']],
                ['brand' => 'Oppo', 'models' => ['OPPO A1', 'OPPO A3', 'OPPO A5', 'OPPO A7', 'OPPO A9', 'OPPO A12', 'OPPO A15', 'OPPO A31', 'OPPO A53', 'OPPO A54']],
                ['brand' => 'Vivo', 'models' => ['Vivo Y11', 'Vivo Y12', 'Vivo Y15', 'Vivo Y17', 'Vivo Y20', 'Vivo Y21', 'Vivo Y30', 'Vivo Y51', 'Vivo V15', 'Vivo V17']],
                ['brand' => 'Realme', 'models' => ['Realme 3', 'Realme 5', 'Realme 6', 'Realme 7', 'Realme 8', 'Realme 9', 'Realme C2', 'Realme C3', 'Realme C11', 'Realme C15']],
                ['brand' => 'Huawei', 'models' => ['Huawei P20', 'Huawei P30', 'Huawei P40', 'Huawei P50', 'Huawei P60', 'Huawei Mate 10', 'Huawei Mate 20', 'Huawei Mate 30', 'Huawei Mate 40', 'Huawei Mate 50']],
                ['brand' => 'OnePlus', 'models' => ['OnePlus 5', 'OnePlus 5T', 'OnePlus 6', 'OnePlus 6T', 'OnePlus 7', 'OnePlus 7 Pro', 'OnePlus 8', 'OnePlus 8 Pro', 'OnePlus 9', 'OnePlus 9 Pro']],
                ['brand' => 'Nokia', 'models' => ['Nokia 1.3', 'Nokia 2.4', 'Nokia 3.4', 'Nokia 5.4', 'Nokia 6.2', 'Nokia 7.2', 'Nokia 8.3', 'Nokia C1', 'Nokia C2', 'Nokia C3']],
                ['brand' => 'Asus (ROG / Zenfone)', 'models' => ['ASUS Zenfone 3', 'ASUS Zenfone 4', 'ASUS Zenfone 5', 'ASUS Zenfone 6', 'ASUS Zenfone 7', 'ASUS Zenfone 8', 'ASUS Zenfone 9', 'ASUS ROG Phone', 'ROG Phone 2', 'ROG Phone 3']],
            ],
            'Laptop' => [
                ['brand' => 'MacBook (Apple)', 'models' => ['MacBook Air M1', 'MacBook Air M2', 'MacBook Air M3', 'MacBook Pro 13"', 'MacBook Pro 14"', 'MacBook Pro 16"', 'MacBook Retina 12"', 'MacBook Pro M1', 'MacBook Pro M2', 'MacBook Pro M3']],
                ['brand' => 'ASUS', 'models' => ['ASUS VivoBook 14', 'ASUS VivoBook 15', 'ASUS ZenBook 13', 'ASUS ZenBook 14', 'ASUS ZenBook Pro', 'ASUS ROG Strix', 'ASUS ROG Zephyrus', 'ASUS TUF Gaming F15', 'ASUS TUF Gaming A15', 'ASUS ExpertBook']],
                ['brand' => 'Lenovo', 'models' => ['Lenovo ThinkPad X1 Carbon', 'Lenovo ThinkPad T14', 'Lenovo ThinkBook 14', 'Lenovo IdeaPad 3', 'Lenovo IdeaPad 5', 'Lenovo IdeaPad Gaming 3', 'Lenovo Legion 5', 'Lenovo Legion 7', 'Lenovo Yoga Slim 7', 'Lenovo Yoga C740']],
                ['brand' => 'HP', 'models' => ['HP Pavilion 14', 'HP Pavilion 15', 'HP Envy 13', 'HP Envy x360', 'HP Spectre x360', 'HP Omen 15', 'HP Victus 15', 'HP ProBook 440', 'HP EliteBook 840', 'HP Chromebook 14']],
                ['brand' => 'Dell', 'models' => ['Dell XPS 13', 'Dell XPS 15', 'Dell Inspiron 14', 'Dell Inspiron 15', 'Dell Vostro 14', 'Dell Vostro 15', 'Dell Latitude 5420', 'Dell Precision 5550', 'Dell G3', 'Dell G5']],
                ['brand' => 'Acer', 'models' => ['Acer Aspire 3', 'Acer Aspire 5', 'Acer Swift 3', 'Acer Swift 5', 'Acer Nitro 5', 'Acer Predator Helios 300', 'Acer Chromebook 314', 'Acer Spin 3', 'Acer Spin 5', 'Acer TravelMate P2']],
                ['brand' => 'MSI', 'models' => ['MSI GF63 Thin', 'MSI GF65 Thin', 'MSI Katana GF66', 'MSI Bravo 15', 'MSI Modern 14', 'MSI Prestige 14', 'MSI Summit E13', 'MSI Stealth 15M', 'MSI Raider GE66', 'MSI Titan GT77']],
                ['brand' => 'Axioo', 'models' => ['Axioo MyBook 14', 'Axioo MyBook 14F', 'Axioo MyBook 15', 'Axioo MyBook Pro', 'Axioo Pongo 960', 'Axioo Pongo 960P', 'Axioo Pongo 725', 'Axioo Pongo 750', 'Axioo Neon', 'Axioo Windroid']],
            ],
            'Komputer / PC' => [
                ['brand' => 'Dell', 'models' => ['OptiPlex 3000', 'OptiPlex 5000', 'OptiPlex 7000', 'Vostro 3681', 'Vostro 3888', 'Inspiron 3881', 'Inspiron 3891', 'XPS 8940', 'XPS 8960', 'Alienware Aurora R10']],
                ['brand' => 'HP', 'models' => ['Pavilion TP01', 'Pavilion TG01', 'Envy TE01', 'Omen 25L', 'Omen 30L', 'ProDesk 400 G6', 'ProDesk 600 G6', 'EliteDesk 800 G6', 'EliteDesk 805 G8', 'Z2 Tower G5']],
                ['brand' => 'Lenovo', 'models' => ['ThinkCentre M70t', 'ThinkCentre M80t', 'ThinkCentre M90t', 'IdeaCentre 3', 'IdeaCentre 5', 'Legion Tower 5', 'Legion Tower 7i', 'ThinkStation P330', 'ThinkStation P340', 'ThinkCentre Neo 30a']],
                ['brand' => 'ASUS', 'models' => ['ROG Strix GT15', 'ROG Strix GL10', 'ROG Huracan', 'TUF Gaming GT301', 'ExpertCenter D5', 'ExpertCenter D7', 'VivoPC X', 'ProArt Station PD5', 'Mini PC PN62', 'Mini PC PN64']],
                ['brand' => 'Acer', 'models' => ['Aspire TC-895', 'Aspire XC-1660', 'Veriton M200', 'Veriton X4670G', 'Predator Orion 3000', 'Predator Orion 5000', 'Nitro N50', 'Nitro N60', 'Chromebox CXI3', 'Aspire C22 AIO']],
                ['brand' => 'Apple', 'models' => ['iMac 21.5"', 'iMac 24" M1', 'iMac 27" Retina', 'iMac Pro', 'Mac mini M1', 'Mac mini M2', 'Mac Studio M1 Max', 'Mac Studio M2 Ultra', 'Mac Pro 2019', 'Mac Pro 2023']],
                ['brand' => 'MSI', 'models' => ['MSI Aegis R', 'MSI Aegis Ti5', 'MSI Trident 3', 'MSI Infinite S', 'MSI Codex R', 'MSI MAG Infinite S', 'MSI Creator P100X', 'MSI Nightblade MI3', 'MSI Cubi 5', 'MSI Cubi N']],
                ['brand' => 'Samsung', 'models' => ['Samsung DP300A2A', 'Samsung DP500A2A', 'Samsung Series 3 Desktop', 'Samsung Series 5 Desktop', 'Samsung ATIV One', 'Samsung DM500A2A', 'Samsung DM700A3B', 'Samsung All-in-One 7', 'Samsung Slim Desktop', 'Samsung Expert Desktop']],
                ['brand' => 'Toshiba', 'models' => ['Dynabook DX100', 'Dynabook DX200', 'Qosmio DX730', 'Satellite Desktop S300', 'Satellite Pro Desktop', 'Portege Desktop', 'Tecra Desktop', 'Toshiba Business PC', 'Toshiba Home PC', 'Toshiba Slim Desktop']],
                ['brand' => 'Fujitsu', 'models' => ['Esprimo D556', 'Esprimo P757', 'Esprimo Q957', 'Celsius W580', 'Celsius M740', 'Celsius R940', 'Futro S740', 'Futro S940', 'Scenic D', 'Scenic Pro']],
            ],
            'Tablet' => [
                ['brand' => 'Apple iPad', 'models' => ['iPad 2', 'iPad 3 (The New iPad)', 'iPad 4', 'iPad 5th Gen', 'iPad 6th Gen', 'iPad 7th Gen', 'iPad 8th Gen', 'iPad 9th Gen', 'iPad 10th Gen', 'iPad Air']],
                ['brand' => 'Samsung Galaxy Tab', 'models' => ['Galaxy Tab A', 'Galaxy Tab A7', 'Galaxy Tab A8', 'Galaxy Tab A9', 'Galaxy Tab S4', 'Galaxy Tab S5e', 'Galaxy Tab S6', 'Galaxy Tab S7', 'Galaxy Tab S8', 'Galaxy Tab S9']],
                ['brand' => 'Xiaomi / Redmi Pad', 'models' => ['Xiaomi Mi Pad', 'Mi Pad 2', 'Mi Pad 3', 'Mi Pad 4', 'Mi Pad 5', 'Mi Pad 5 Pro', 'Redmi Pad', 'Redmi Pad SE', 'Redmi Pad Pro', 'Xiaomi Pad 6']],
                ['brand' => 'Huawei MatePad', 'models' => ['Huawei MediaPad T3', 'Huawei MediaPad T5', 'Huawei MediaPad M3', 'Huawei MediaPad M5', 'Huawei MediaPad M6', 'Huawei MatePad T10', 'Huawei MatePad T10s', 'Huawei MatePad 10.4', 'Huawei MatePad 11', 'Huawei MatePad Pro']],
                ['brand' => 'Lenovo Tab', 'models' => ['Lenovo Tab M7', 'Lenovo Tab M8', 'Lenovo Tab M9', 'Lenovo Tab M10', 'Lenovo Tab P10', 'Lenovo Tab P11', 'Lenovo Tab P12', 'Lenovo Yoga Tab 3', 'Lenovo Yoga Tab 10', 'Lenovo Yoga Tab 11']],
                ['brand' => 'ASUS Tablet', 'models' => ['ASUS ZenPad 7.0', 'ASUS ZenPad 8.0', 'ASUS ZenPad 10', 'ASUS ZenPad S 8.0', 'ASUS ZenPad C 7.0', 'ASUS ZenPad Z8', 'ASUS Transformer Pad TF300', 'ASUS Transformer Pad TF701', 'ASUS Transformer Mini', 'ASUS Transformer Book T100']],
                ['brand' => 'Microsoft Surface', 'models' => ['Surface RT', 'Surface 2', 'Surface Pro', 'Surface Pro 2', 'Surface Pro 3', 'Surface Pro 4', 'Surface Pro 5', 'Surface Pro 6', 'Surface Pro 7', 'Surface Pro 8']],
                ['brand' => 'Realme Pad', 'models' => ['Realme Pad', 'Realme Pad Mini', 'Realme Pad Slim', 'Realme Pad X', 'Realme Pad 2', 'Realme Pad Pro', 'Realme Pad LTE', 'Realme Pad WiFi', 'Realme Pad Ultra', 'Realme Pad Air']],
                ['brand' => 'OPPO Pad', 'models' => ['OPPO Pad', 'OPPO Pad Air', 'OPPO Pad Neo', 'OPPO Pad Pro', 'OPPO Pad 2', 'OPPO Pad 3', 'OPPO Pad Mini', 'OPPO Pad Plus', 'OPPO Pad SE', 'OPPO Pad X']],
                ['brand' => 'Amazon Fire', 'models' => ['Fire 7', 'Fire HD 8', 'Fire HD 10', 'Fire Kids Edition', 'Fire HD 8 Plus', 'Fire HD 10 Plus', 'Kindle Fire', 'Kindle Fire HD', 'Kindle Fire HDX', 'Fire Max 11']],
            ],
            'Televisi (TV)' => [
                ['brand' => 'Samsung TV', 'models' => ['Samsung Q60', 'Samsung Q70', 'Samsung Q80', 'Samsung Q90', 'Samsung QN85', 'Samsung QN90', 'Samsung QN95', 'Samsung AU7000', 'Samsung AU8000', 'Samsung TU7000']],
                ['brand' => 'LG TV', 'models' => ['LG UHD AI ThinQ', 'LG NanoCell 75', 'LG NanoCell 80', 'LG NanoCell 85', 'LG OLED B2', 'LG OLED C2', 'LG OLED G2', 'LG OLED Z2', 'LG QNED80', 'LG QNED85']],
                ['brand' => 'Sony Bravia', 'models' => ['Sony Bravia X70', 'Sony Bravia X75', 'Sony Bravia X80', 'Sony Bravia X85', 'Sony Bravia X90', 'Sony Bravia X95', 'Sony Bravia A80 OLED', 'Sony Bravia A90 OLED', 'Sony Bravia Z8H', 'Sony Bravia Z9J']],
                ['brand' => 'TCL TV', 'models' => ['TCL S6500', 'TCL S6800', 'TCL S7200', 'TCL P615', 'TCL P725', 'TCL P735', 'TCL C725', 'TCL C735', 'TCL C845', 'TCL X925']],
                ['brand' => 'Panasonic TV', 'models' => ['Panasonic Viera TH', 'Panasonic HX600', 'Panasonic HX750', 'Panasonic HX900', 'Panasonic JX600', 'Panasonic JX750', 'Panasonic JX900', 'Panasonic LX700', 'Panasonic LX800', 'Panasonic LZ800 OLED']],
                ['brand' => 'Sharp TV', 'models' => ['Sharp Aquos 2T', 'Sharp Aquos 4T', 'Sharp Aquos 8T', 'Sharp LE185', 'Sharp LE265', 'Sharp LC Series', 'Sharp Easy Smart TV', 'Sharp Android TV', 'Sharp UHD 4K', 'Sharp Quattron']],
                ['brand' => 'Hisense TV', 'models' => ['Hisense A4', 'Hisense A6', 'Hisense A7', 'Hisense A8', 'Hisense U6', 'Hisense U7', 'Hisense U8', 'Hisense U9', 'Hisense Vidaa Smart TV', 'Hisense Laser TV']],
                ['brand' => 'Philips TV', 'models' => ['Philips 4000 Series', 'Philips 5000 Series', 'Philips 6000 Series', 'Philips 7000 Series', 'Philips 8000 Series', 'Philips 9000 Series', 'Philips Ambilight TV', 'Philips OLED 7 Series', 'Philips OLED 8 Series', 'Philips Smart TV']],
                ['brand' => 'Xiaomi TV', 'models' => ['Mi TV 4A', 'Mi TV 4X', 'Mi TV 5A', 'Mi TV 5X', 'Mi TV P1', 'Mi TV Q1', 'Mi TV ES', 'Mi TV Master', 'Redmi Smart TV X', 'Redmi Smart TV A']],
                ['brand' => 'Polytron TV', 'models' => ['Polytron PLD', 'Polytron Cinemax', 'Polytron Smart TV', 'Polytron LED TV', 'Polytron 4K UHD', 'Polytron Android TV', 'Polytron Big Screen', 'Polytron PLG Series', 'Polytron PLS Series', 'Polytron Smart Cinema']],
            ],
        'Kulkas' => [
                ['brand' => 'LG Refrigerator', 'models' => ['LG GN-B185', 'LG GN-B195', 'LG GN-H602', 'LG GN-H722', 'LG InstaView Door-in-Door', 'LG Smart Inverter', 'LG Side by Side GC-B247', 'LG Multi Door', 'LG Bottom Freezer', 'LG Top Freezer']],
                ['brand' => 'Samsung Refrigerator', 'models' => ['Samsung RT19', 'Samsung RT22', 'Samsung RT25', 'Samsung RT29', 'Samsung Bespoke', 'Samsung Family Hub', 'Samsung Twin Cooling Plus', 'Samsung Digital Inverter', 'Samsung Side by Side RS64', 'Samsung French Door RF28']],
                ['brand' => 'Sharp Refrigerator', 'models' => ['Sharp SJ-195MD', 'Sharp SJ-246', 'Sharp SJ-316', 'Sharp SJ-420', 'Sharp Plasmacluster', 'Sharp J-Tech Inverter', 'Sharp Side by Side', 'Sharp French Door', 'Sharp Mini Bar', 'Sharp Hybrid Cooling']],
                ['brand' => 'Panasonic Refrigerator', 'models' => ['Panasonic NR-BB211', 'Panasonic NR-BX410', 'Panasonic NR-DZ600', 'Panasonic NR-F510', 'Panasonic Econavi', 'Panasonic Prime Fresh', 'Panasonic Side by Side', 'Panasonic French Door', 'Panasonic Inverter Series', 'Panasonic Top Freezer']],
                ['brand' => 'Toshiba Refrigerator', 'models' => ['Toshiba GR-B175', 'Toshiba GR-B195', 'Toshiba GR-H822', 'Toshiba GR-RF610', 'Toshiba Origin Inverter', 'Toshiba Multi Door', 'Toshiba Side by Side', 'Toshiba Hybrid Bio', 'Toshiba Smart Cooling', 'Toshiba Pure Bio']],
                ['brand' => 'AQUA', 'models' => ['Aqua AQR-D180', 'Aqua AQR-D220', 'Aqua AQR-D260', 'Aqua AQR-VD180', 'Aqua Japan Series', 'Aqua Magic Cooling', 'Aqua Big Freezer', 'Aqua Top Freezer', 'Aqua Bottom Freezer', 'Aqua Multi Air Flow']],
                ['brand' => 'Polytron Refrigerator', 'models' => ['Polytron PRB 18', 'Polytron PRB 19', 'Polytron PRB 20', 'Polytron PRO Series', 'Polytron Belleza', 'Polytron Hybrid Cooling', 'Polytron Smart Inverter', 'Polytron Side by Side', 'Polytron Glass Door', 'Polytron Double Door']],
                ['brand' => 'Electrolux Refrigerator', 'models' => ['Electrolux EME3500', 'Electrolux ESE5600', 'Electrolux ETB2300', 'Electrolux EQE6000', 'Electrolux NutriFresh', 'Electrolux TasteLock', 'Electrolux TasteGuard', 'Electrolux Side by Side', 'Electrolux French Door', 'Electrolux Multi Door']],
                ['brand' => 'Hitachi Refrigerator', 'models' => ['Hitachi R-H350', 'Hitachi R-WB640', 'Hitachi R-ZX740', 'Hitachi R-VG440', 'Hitachi Inverter X', 'Hitachi Side by Side', 'Hitachi French Door', 'Hitachi Vacuum Compartment', 'Hitachi Frost Free', 'Hitachi Dual Fan Cooling']],
                ['brand' => 'Mitsubishi Electric', 'models' => ['Mitsubishi MR-FC', 'Mitsubishi MR-CX', 'Mitsubishi MR-WX', 'Mitsubishi MR-ZX', 'Mitsubishi Neuro Inverter', 'Mitsubishi Vitamin Factory', 'Mitsubishi Glass Door', 'Mitsubishi Multi Door', 'Mitsubishi Side by Side', 'Mitsubishi French Door']],
            ],
            'Mesin Cuci' => [
                ['brand' => 'LG Washing Machine', 'models' => ['LG Smart Inverter', 'LG TurboDrum', 'LG T2107', 'LG T2185', 'LG FH0B8NDL2', 'LG FC1408S4W', 'LG TwinWash', 'LG Direct Drive', 'LG Front Load Series', 'LG Top Load Series']],
                ['brand' => 'Samsung Washing Machine', 'models' => ['Samsung EcoBubble', 'Samsung QuickDrive', 'Samsung AddWash', 'Samsung Activ DualWash', 'Samsung WA70', 'Samsung WA80', 'Samsung WA90', 'Samsung WW65', 'Samsung WW75', 'Samsung WW85']],
                ['brand' => 'Sharp Washing Machine', 'models' => ['Sharp ES-T85', 'Sharp ES-T95', 'Sharp ES-F850', 'Sharp ES-F950', 'Sharp Megamouth', 'Sharp Double Pulsator', 'Sharp Dolphinwave', 'Sharp Front Load Series', 'Sharp Top Load Series', 'Sharp Twin Tub']],
                ['brand' => 'Panasonic Washing Machine', 'models' => ['Panasonic NA-W70', 'Panasonic NA-W80', 'Panasonic NA-F80', 'Panasonic NA-F90', 'Panasonic Econavi', 'Panasonic StainMaster', 'Panasonic Front Load', 'Panasonic Top Load', 'Panasonic Twin Tub', 'Panasonic Inverter Series']],
                ['brand' => 'Toshiba Washing Machine', 'models' => ['Toshiba AW-A800', 'Toshiba AW-B1000', 'Toshiba TW-BH85', 'Toshiba TW-BK105', 'Toshiba GreatWaves', 'Toshiba Real Inverter', 'Toshiba Front Load', 'Toshiba Top Load', 'Toshiba Twin Tub', 'Toshiba Magic Drum']],
                ['brand' => 'AQUA Washing Machine', 'models' => ['Aqua AQW-78', 'Aqua AQW-88', 'Aqua AQW-98', 'Aqua QW-105', 'Aqua Japan Technology', 'Aqua Magic Filter', 'Aqua Top Load', 'Aqua Front Load', 'Aqua Twin Tub', 'Aqua Hijab Series']],
                ['brand' => 'Polytron Washing Machine', 'models' => ['Polytron PWM 705', 'Polytron PWM 806', 'Polytron PWM 910', 'Polytron Zeromatic', 'Polytron WonderWash', 'Polytron Smart Wash', 'Polytron Twin Tub', 'Polytron Front Load', 'Polytron Top Load', 'Polytron Hijab Series']],
                ['brand' => 'Electrolux Washing Machine', 'models' => ['Electrolux EWF85743', 'Electrolux EWF12844', 'Electrolux EWW9024', 'Electrolux EWW1274', 'Electrolux UltimateCare', 'Electrolux Vapour Care', 'Electrolux SensorWash', 'Electrolux IntelliQuick', 'Electrolux Front Load', 'Electrolux Top Load']],
                ['brand' => 'Hitachi Washing Machine', 'models' => ['Hitachi SF-120XAV', 'Hitachi SF-130XAV', 'Hitachi BD-W80', 'Hitachi BD-W90', 'Hitachi Big Drum', 'Hitachi Inverter Series', 'Hitachi Top Load', 'Hitachi Front Load', 'Hitachi Twin Tub', 'Hitachi Auto Dosing']],
                ['brand' => 'Mitsubishi Washing Machine', 'models' => ['Mitsubishi MAW-80', 'Mitsubishi MAW-100', 'Mitsubishi Twin Tub', 'Mitsubishi Diamond Drum', 'Mitsubishi Inverter Series', 'Mitsubishi Power Wash', 'Mitsubishi Top Load', 'Mitsubishi Front Load', 'Mitsubishi Eco Wash', 'Mitsubishi Quick Wash']],
            ],
            'AC (Air Conditioner)' => [
                ['brand' => 'Daikin AC', 'models' => ['Daikin FTKC Series', 'Daikin FTNE Series', 'Daikin FTKF Series', 'Daikin Standard Series', 'Daikin Smile Series', 'Daikin Flash Inverter', 'Daikin Star Inverter', 'Daikin Urusara 7', 'Daikin SkyAir', 'Daikin Super Mini Split']],
                ['brand' => 'Panasonic AC', 'models' => ['Panasonic CS-PN Series', 'Panasonic CS-XPU Series', 'Panasonic CS-YN Series', 'Panasonic Deluxe Series', 'Panasonic Inverter Series', 'Panasonic Aero Inverter', 'Panasonic Sky Series', 'Panasonic PACi', 'Panasonic VRF', 'Panasonic Nanoe-G']],
                ['brand' => 'LG AC', 'models' => ['LG Dual Inverter', 'LG Artcool', 'LG Standard Plus', 'LG Smart Inverter', 'LG DUALCOOL', 'LG Multi Split', 'LG Ceiling Cassette', 'LG Floor Standing', 'LG Window AC', 'LG Portable AC']],
                ['brand' => 'Samsung AC', 'models' => ['Samsung Wind-Free', 'Samsung AR05 Series', 'Samsung AR10 Series', 'Samsung AR12 Series', 'Samsung Digital Inverter', 'Samsung Fast Cooling', 'Samsung Triple Protector Plus', 'Samsung DVM S', 'Samsung Cassette', 'Samsung Slim Duct']],
                ['brand' => 'Sharp AC', 'models' => ['Sharp AH-X Series', 'Sharp AH-A Series', 'Sharp AH-P Series', 'Sharp Standard Series', 'Sharp J-Tech Inverter', 'Sharp Plasmacluster', 'Sharp Split Wall Series', 'Sharp Floor Standing', 'Sharp Portable AC', 'Sharp Window AC']],
                ['brand' => 'Mitsubishi Electric AC', 'models' => ['Mitsubishi MSZ Series', 'Mitsubishi Mr. Slim', 'Mitsubishi Heavy Duty', 'Mitsubishi Inverter Series', 'Mitsubishi Deluxe Series', 'Mitsubishi Standard Series', 'Mitsubishi Plasma Quad Plus', 'Mitsubishi Multi Split', 'Mitsubishi Ceiling Cassette', 'Mitsubishi Ducted Type']],
                ['brand' => 'Gree AC', 'models' => ['Gree GWC Series', 'Gree Lomo Series', 'Gree Fairy Series', 'Gree Viola Series', 'Gree Smart Inverter', 'Gree U-Crown', 'Gree Split Wall Series', 'Gree Floor Standing', 'Gree Cassette Type', 'Gree Duct Type']],
                ['brand' => 'Hitachi AC', 'models' => ['Hitachi RAS Series', 'Hitachi RAF Series', 'Hitachi Standard Series', 'Hitachi Inverter Series', 'Hitachi Premium Series', 'Hitachi iClean', 'Hitachi X-Power', 'Hitachi Multi Split', 'Hitachi Floor Standing', 'Hitachi Cassette']],
                ['brand' => 'TCL AC', 'models' => ['TCL TAC Series', 'TCL Elite Series', 'TCL Inverter Series', 'TCL Smart AC', 'TCL Gentle Breeze', 'TCL Turbo Cooling', 'TCL Split Wall', 'TCL Window AC', 'TCL Portable AC', 'TCL Floor Standing']],
                ['brand' => 'Polytron AC', 'models' => ['Polytron Neuva Ice', 'Polytron Deluxe Series', 'Polytron Standard Series', 'Polytron Inverter Series', 'Polytron Smart Series', 'Polytron Split Wall', 'Polytron Floor Standing', 'Polytron Portable AC', 'Polytron Cassette Type', 'Polytron Low Watt Series']],
            ],
            'Kipas Angin' => [
                ['brand' => 'Cosmos', 'models' => ['Cosmos 16-XDA', 'Cosmos 16-SDB', 'Cosmos 16-SB', 'Cosmos 12-LGA', 'Cosmos 12-DSE', 'Cosmos Stand Fan Series', 'Cosmos Desk Fan Series', 'Cosmos Wall Fan Series', 'Cosmos Box Fan Series', 'Cosmos Industrial Fan']],
                ['brand' => 'Miyako', 'models' => ['Miyako KAS-1606', 'Miyako KAS-1618', 'Miyako KAS-1637', 'Miyako KAS-1690', 'Miyako KDB-1218', 'Miyako Desk Fan Series', 'Miyako Stand Fan Series', 'Miyako Wall Fan Series', 'Miyako Box Fan Series', 'Miyako Mini Fan']],
                ['brand' => 'Maspion', 'models' => ['Maspion PW-1200', 'Maspion PW-1400', 'Maspion PW-1600', 'Maspion PW-1800', 'Maspion Desk Fan Series', 'Maspion Stand Fan Series', 'Maspion Wall Fan Series', 'Maspion Box Fan Series', 'Maspion Industrial Fan', 'Maspion Ceiling Fan']],
                ['brand' => 'Panasonic', 'models' => ['Panasonic F-EP401', 'Panasonic F-EP301', 'Panasonic F-EP201', 'Panasonic F-EK306', 'Panasonic F-EK404', 'Panasonic Desk Fan Series', 'Panasonic Stand Fan Series', 'Panasonic Wall Fan Series', 'Panasonic Box Fan Series', 'Panasonic Ceiling Fan']],
                ['brand' => 'Sharp', 'models' => ['Sharp PJ-A26', 'Sharp PJ-A36', 'Sharp PJ-D16', 'Sharp PJ-D18', 'Sharp Desk Fan Series', 'Sharp Stand Fan Series', 'Sharp Wall Fan Series', 'Sharp Box Fan Series', 'Sharp Ceiling Fan', 'Sharp Tower Fan']],
                ['brand' => 'KDK', 'models' => ['KDK M40A', 'KDK M30K', 'KDK T40A', 'KDK T60A', 'KDK Ceiling Fan Series', 'KDK Wall Fan Series', 'KDK Stand Fan Series', 'KDK Desk Fan Series', 'KDK Industrial Fan', 'KDK Remote Fan']],
                ['brand' => 'Sekai', 'models' => ['Sekai SFN-1620', 'Sekai SFN-1820', 'Sekai Desk Fan Series', 'Sekai Stand Fan Series', 'Sekai Wall Fan Series', 'Sekai Box Fan Series', 'Sekai Industrial Fan', 'Sekai Mini Fan', 'Sekai Clip Fan', 'Sekai Ceiling Fan']],
                ['brand' => 'Sanken', 'models' => ['Sanken SF-1610', 'Sanken SF-1620', 'Sanken SF-1630', 'Sanken SF-1800', 'Sanken Desk Fan Series', 'Sanken Stand Fan Series', 'Sanken Wall Fan Series', 'Sanken Box Fan Series', 'Sanken Ceiling Fan', 'Sanken Tower Fan']],
                ['brand' => 'Arashi', 'models' => ['Arashi A-1601', 'Arashi A-1801', 'Arashi A-2001', 'Arashi Desk Fan Series', 'Arashi Stand Fan Series', 'Arashi Wall Fan Series', 'Arashi Box Fan Series', 'Arashi Ceiling Fan', 'Arashi Tower Fan', 'Arashi Mini Fan']],
                ['brand' => 'Advance', 'models' => ['Advance Kipas 16 Inch', 'Advance Kipas 18 Inch', 'Advance Desk Fan Series', 'Advance Stand Fan Series', 'Advance Wall Fan Series', 'Advance Box Fan Series', 'Advance Ceiling Fan', 'Advance Tower Fan', 'Advance Mini Fan', 'Advance Clip Fan']],
            ],
        ];

        foreach ($categories as $cat => $brands) {
            foreach ($brands as $brand => $models) {
                foreach ($models as $model) {
                    Product::create([
                        'name' => "$brand $model",
                        'category' => $cat,
                        'brand' => $brand,
                        'model' => $model,
                        'description' => "Deskripsi untuk $brand $model.",
                        'grade' => ['A', 'B', 'C', 'D'][rand(0, 3)],
                        'location' => 'Jakarta',
                        'stock' => rand(1, 50),
                        'price' => rand(1000000, 20000000),
                        'image' => 'https://via.placeholder.com/300x200?text=' . urlencode("$brand $model"),
                        'user_id' => $user->id,
                    ]);
                }
            }
        }
    }
}