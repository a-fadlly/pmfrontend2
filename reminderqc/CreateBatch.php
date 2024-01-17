<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION["access_token"])) {
    header("Location: ../login.php");
}
require_once('../config/db_connect.php');
require_once('../controller/reminderqc.php');

$reminderQCController = new ReminderQCController($db);
$products = $reminderQCController->getProducts();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $batch_number = $_POST['batch_number'];
    $mfg_date = $_POST['mfg_date'];
    $exp_date = $_POST['exp_date'];
    $sample_date = $_POST['sample_date'];

    $types = isset($_POST['types']) ? $_POST['types'] : array();

    $storage_conditions = json_encode(array(
        'realtime' => $_POST['realtimeInput'] ?? "",
        'accelerated' => $_POST['acceleratedInput'] ?? "",
        'ongoing' => $_POST['ongoingInput'] ?? ""
    ));

    $packaging_type = $_POST['packaging_type'];

    $selectedEmails = isset($_POST['emails']) ? $_POST['emails'] : [];
    $jsonEmails = json_encode($selectedEmails);

    $batch_id = $reminderQCController->createBatch($product_id, $batch_number, $mfg_date, $exp_date, $sample_date, json_encode($types), $storage_conditions, $packaging_type, $jsonEmails);
    if ($batch_id == false) {
        echo "Error adding item.";
    } else {
        if ($reminderQCController->createTestsByBatch($batch_id, new DateTime($sample_date), new DateTime($exp_date), $types)) {
            header('Location: Products.php');
            exit();
        }
    }
}
?>
<?php include 'header.php' ?>
<div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Create Batch
                            <span class="d-block text-muted pt-2 font-size-sm">A case is placed in the user's inbox when the current task in the case has been assigned to their account</span>

                        </h3>
                    </div>
                </div>
                <form class="form" method="post" action="CreateBatch.php">
                    <div class="card-body">
                        <div class="form-group row ">
                            <div class="col-lg-6">
                                <label>Product <span class="font-italic">(Produk)</span>:</label>
                                <select id="product_id" name="product_id" class="form-control">
                                    <option>-</option>
                                    <?php foreach ($products as $product) { ?>
                                        <option value="<?= $product["id"] ?>"><?= $product["number"] ?> <?= $product["name"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label>Batch Number <span class="font-italic">(Nomor Batch)</span>:</label>
                                <input id="batch_number" name="batch_number" type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-lg-4">
                                <label>Mfg Date:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                    </div>
                                    <input id="mfg_date" name="mfg_date" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label>Exp Date:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                    </div>
                                    <input id="exp_date" name="exp_date" type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <label>Sample Date:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                    </div>
                                    <input id="sample_date" name="sample_date" type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Test Type:</label>
                                    <div class="checkbox-list">
                                        <label class="checkbox">
                                            <input id="realtime" name="types[]" type="checkbox" class="toggle-input" data-target="realtime" value="realtime" />
                                            <span></span>Realtime
                                        </label>
                                        <label class="checkbox">
                                            <input id="accelerated" name="types[]" type="checkbox" class="toggle-input" data-target="accelerated" value="accelerated" />
                                            <span></span>Accelerated
                                        </label>
                                        <label class="checkbox">
                                            <input id="ongoing" name="types[]" type="checkbox" class="toggle-input" data-target="ongoing" value="ongoing" />
                                            <span></span>On-going
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row realtime-input">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Kondisi Penyimpanan (Realtime):</label>
                                    <input type="text" id="realtimeInput" name="realtimeInput" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row accelerated-input">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Kondisi Penyimpanan (Accelerated):</label>
                                    <input type="text" id="acceleratedInput" name="acceleratedInput" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row ongoing-input">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Kondisi Penyimpanan (On-going):</label>
                                    <input type="text" name="ongoingInput" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Jenis Kemasan <span class="font-italic">(Packaging Type)</span>:</label>
                                    <input id="packaging_type" name="packaging_type" type="text" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label>Email:</label>
                                <select class="form-control select2" id="emails" name="emails[]" multiple="multiple">
                                    <option value='Abdul_Cholik@mersifarma.com'>Abdul Rachman Cholik</option>
                                    <option value='Abdul_Latif@mersifarma.com'>Abdul Latif</option>
                                    <option value='Accounting@mersifarma.com'>Fatmania Indriana</option>
                                    <option value='Acep_E@mersifarma.com'>Muhammad Acep Ereh</option>
                                    <option value='achmad.its@mersifarma.com'>Achmad Fadlly</option>
                                    <option value='Achmad_T@mersifarma.com'>Achmad Nurti Toni</option>
                                    <option value='Adhi_N@mersifarma.com'>Adhi Nugroho</option>
                                    <option value='Adhiny_Helmi@mersifarma.com'>Adhiny Disti Helmi</option>
                                    <option value='Adi_Perwiradireja@mersifarma.com'>R Adi Perwiradireja NULL</option>
                                    <option value='Adi_Perwiradireja@mersifarma.com'>Adi Perwiradireja</option>
                                    <option value='Admin.SC@mersifarma.com'>Witri Emika</option>
                                    <option value='agegen_labkimia@mersifarma.com'>Agegen Laboratorium Kimia</option>
                                    <option value='agegen_labmikro@mersifarma.com'>Agegen Laboratorium Mikrobiologi</option>
                                    <option value='agegen_qcipc@mersifarma.com'>Agegen Quality Control â€“ In Process Control</option>
                                    <option value='agegen_qcoffice@mersifarma.com'>Agegen Prasetyo</option>
                                    <option value='Agung_Dwiantoro@mersifarma.com'>Agung Dwiantoro</option>
                                    <option value='Agung_Sasongko@mersifarma.com'>Agung Tri Sasongko</option>
                                    <option value='Agus_coko@mersifarma.com'>Agus Sancoko</option>
                                    <option value='Agus_P@mersifarma.com'>Agus Priyatna</option>
                                    <option value='Agus_Purnomo@mersifarma.com'>Agus Purnomo</option>
                                    <option value='Agus_S@mersifarma.com'>Agus Sulistyanto</option>
                                    <option value='Agus_Setiawan@mersifarma.com'>Agus setiawan</option>
                                    <option value='agus_suhanda@mersifarma.com'>Agus Suhanda</option>
                                    <option value='Ahmad.hr@mersifarma.com'>Ahmad Surya</option>
                                    <option value='Ahmad_Baidhowi@mersifarma.com'>Ahmad Baidhowi</option>
                                    <option value='Ahmad_Sofiyan@mersifarma.com'>Ahmad Yani Sofiyan</option>
                                    <option value='ajeng_damayanti@mersifarma.com'>Ajeng Damayanti</option>
                                    <option value='Ajeng_Nabilla@mersifarma.com'>Ajeng Raffi Nabilla</option>
                                    <option value='Ajeng_Pratiwi@mersifarma.com'>Ajeng Triwahyuni Pratiwi</option>
                                    <option value='Alabaster_Siahaan@mersifarma.com'>Alabaster Junior Siahaan</option>
                                    <option value='Alfa_Octavia@mersifarma.com'>Alfa Octavia</option>
                                    <option value='Alfa_Purba@mersifarma.com'>Alfa Wezy Anugrah Purba</option>
                                    <option value='Amalia_Permatasari@mersifarma.com'>Amalia Octa Permatasari</option>
                                    <option value='Amelia_Sari@mersifarma.com'>Amelia Ananda Sari</option>
                                    <option value='Amita_Afini@mersifarma.com'>Amita Putri Afini</option>
                                    <option value='Andi_Rahadi@mersifarma.com'>Andi Rahman Rahadi</option>
                                    <option value='Andika_Hidayat@mersifarma.com'>Andika Muhamad Hidayat</option>
                                    <option value='Andriana_Martadiputra@mersifarma.com'>Andriana Martadiputra</option>
                                    <option value='Andriyani@mersifarma.com'>Andriyani NULL</option>
                                    <option value='Anesya.pcs@mersifarma.com'>Anesya Ulfha</option>
                                    <option value='Aneu_Utami@mersifarma.com'>Aneu Nur Utami</option>
                                    <option value='Angga_Ferdiana@mersifarma.com'>Angga Yudha Ferdiana</option>
                                    <option value='Angga_P@mersifarma.com'>Angga Priyantono</option>
                                    <option value='Anggun_Pasha@mersifarma.com'>Anggun Prawestri Pasha</option>
                                    <option value='Angia.fin@mersifarma.com'>An Gia Maya Widyastuti</option>
                                    <option value='Anisa_Nabila@mersifarma.com'>Anisa Yumna Nabila</option>
                                    <option value='Anita_Ruliyani@mersifarma.com'>Anita Ruliyani</option>
                                    <option value='anjas_wijaya@mersifarma.com'>Anjas Susanto Wijaya</option>
                                    <option value='Annisa_Hijriah@mersifarma.com'>Annisa Hijriah</option>
                                    <option value='Annita_Lestari@mersifarma.com'>Annita Fatimah Lestari</option>
                                    <option value='Aprilla_Wulansari@mersifarma.com'>Aprilla Wulansari</option>
                                    <option value='Ardea_Ramadhan@mersifarma.com'>Ardea Achmad Ramadhan</option>
                                    <option value='Ardian_Pradana@mersifarma.com'>Ardian Wahyu Pradana</option>
                                    <option value='Ardiansyah_Rahmat@mersifarma.com'>Ardiansyah Rahmat</option>
                                    <option value='Ari_Muharjo@mersifarma.com'>Ari Muharjo</option>
                                    <option value='Ari_P@mersifarma.com'>Ari Prabowo</option>
                                    <option value='Ari_Riansyah@mersifarma.com'>Ari Firmansyah Riansyah</option>
                                    <option value='Ari_S@mersifarma.com'>Ari Srimulyani</option>
                                    <option value='Ari_Wibowo@mersifarma.com'>Ari Wibowo</option>
                                    <option value='Arif_Y@mersifarma.com'>Arif Yulianto</option>
                                    <option value='Arini_Kuntasih@mersifarma.com'>Arini Kuntasih</option>
                                    <option value='Ariska_Purwanti@mersifarma.com'>Ariska Purwanti</option>
                                    <option value='Arum_Aprilliani@mersifarma.com'>Arum Aprilliani</option>
                                    <option value='Asep.mkt@mersifarma.com'>Asep Samsul M</option>
                                    <option value='Asep.tek@mersifarma.com'>Asep Saepudin</option>
                                    <option value='Asep_Mulyadi@mersifarma.com'>Asep Mulyadi</option>
                                    <option value='Asharf_Nataszja@mersifarma.com'>Asharf Nataszja</option>
                                    <option value='Asikin_W@mersifarma.com'>Asikin Widjaya</option>
                                    <option value='Athina_Sherene@mersifarma.com'>Athina Sherene</option>
                                    <option value='Aurizal_Risandy@mersifarma.com'>Aurizal Risandy</option>
                                    <option value='Auswady_M@mersifarma.com'>Auswady Machmudy</option>
                                    <option value='Ayu_Arham@mersifarma.com'>Ayu Halida Arham</option>
                                    <option value='Ayu_S@mersifarma.com'>Ayu Cipta Swasana</option>
                                    <option value='Ayustina_Putri@mersifarma.com'>Ayustina Dwi Putri</option>
                                    <option value='Bahrul_Hidayat@mersifarma.com'>Bahrul Hidayat</option>
                                    <option value='Baiq_Fatmayanti@mersifarma.com'>Baiq Risma Fatmayanti</option>
                                    <option value='Bambang_S@mersifarma.com'>Bambang Suprijatno</option>
                                    <option value='Barbara_Putra@mersifarma.com'>Barbara Rahmatsyah Putra</option>
                                    <option value='Basuki_H@mersifarma.com'>Basuki Hadi</option>
                                    <option value='Bella_Yusup@mersifarma.com'>Bella Maulana Yusup</option>
                                    <option value='Benyamen_Christo@mersifarma.com'>Benyamen Christo</option>
                                    <option value='Betris_Damin@mersifarma.com'>Betris Candra Sari Damin</option>
                                    <option value='Bianca_Hidayat@mersifarma.com'>Bianca Putri Hidayat</option>
                                    <option value='Bima_Prakoso@mersifarma.com'>Bima Ajie Prakoso</option>
                                    <option value='bintang_m@mersifarma.com'>Bintang Meidula</option>
                                    <option value='Bobby_Iskandar@mersifarma.com'>Bobby Iskandar</option>
                                    <option value='Briliant_Soetjipto@mersifarma.com'>Briliant Apriadi Dwi Soetjipto</option>
                                    <option value='Brilliant_Apritadila@mersifarma.com'>Brilliant Kharisma Apritadila</option>
                                    <option value='budiyono@mersifarma.com'>Budiyono Budiyono</option>
                                    <option value='bugi_ramdani@mersifarma.com'>Bugi Ramdani</option>
                                    <option value='Cahya_D@mersifarma.com'>Cahya Dwiatmaja</option>
                                    <option value='Cahya_Gumawang@mersifarma.com'>Cahya Gumawang</option>
                                    <option value='Carwono@mersifarma.com'>Carwono Carwono</option>
                                    <option value='Catur_Rahmawati@mersifarma.com'>Catur Putri Rahmawati</option>
                                    <option value='Chaluvagali_Raju@mersifarma.com'>Chaluvagali Pradeep Raju</option>
                                    <option value='Chek_Sokny@mersifarma.com'>Chek Sokny</option>
                                    <option value='Chie_D@mersifarma.com'>Chie Chie Doresna</option>
                                    <option value='Christian_Panjaitan@mersifarma.com'>Christian Panjaitan</option>
                                    <option value='Cleaning_Validation@mersifarma.com'>Miftahul Jannah</option>
                                    <option value='Damar.pro@mersifarma.com'>Damar Mukti</option>
                                    <option value='danipratomo@mersifarma.com'>Mohamad Dani Pratomo</option>
                                    <option value='Darma_Suyedisyah@mersifarma.com'>Darma Suyedisyah</option>
                                    <option value='Darwin_Aryfianata@mersifarma.com'>Darwin Aryfianata</option>
                                    <option value='David_Aron@mersifarma.com'>David Aron</option>
                                    <option value='Dea_Anggraeni@mersifarma.com'>Dea Putri Anggraeni</option>
                                    <option value='Deanovi_Putri@mersifarma.com'>Deanovi Auliana Putri</option>
                                    <option value='Dessy_Yudita@mersifarma.com'>Dessy Clarisa Eka Yudita</option>
                                    <option value='Desyanda_Pramudita@mersifarma.com'>Desyanda Raheswari Pramudita</option>
                                    <option value='Dewi.pro@mersifarma.com'>Dewi Yuliawati</option>
                                    <option value='Dewi_Aryani@mersifarma.com'>Dewi Aryani</option>
                                    <option value='Dian_Indriani@mersifarma.com'>Dian Verina Indriani</option>
                                    <option value='Dian_K@mersifarma.com'>Dian Kristiani</option>
                                    <option value='Diana_Liati@mersifarma.com'>Diana Kriska Suci Liati</option>
                                    <option value='Didi_Hidayat@mersifarma.com'>Didi Hidayat</option>
                                    <option value='didikusumanto@mersifarma.com'>Didi Kusumanto</option>
                                    <option value='Dinda_Arditta@mersifarma.com'>Dinda Arditta</option>
                                    <option value='Dinda_Maulidia@mersifarma.com'>Dinda Rafa Maulidia</option>
                                    <option value='Dini_Nabilah@mersifarma.com'>Dini Nabilah</option>
                                    <option value='Doddy_Hermawan@mersifarma.com'>Doddy Hermawan</option>
                                    <option value='Doni_Danurgawanto@mersifarma.com'>Doni Danurgawanto</option>
                                    <option value='Donny_Adriyadi@mersifarma.com'>Donny Adriyadi</option>
                                    <option value='Donny_Adriyadi@mersifarma.com'>Donny Adriyadi</option>
                                    <option value='Donny_Setiawan@mersifarma.com'>Donny Setiawan</option>
                                    <option value='Dony_Afriyandi@mersifarma.com'>Dony Afriyandi</option>
                                    <option value='Drafter_Project@mersifarma.com'>Zeny Rafiyanto</option>
                                    <option value='Dwi_Fitriani@mersifarma.com'>Dwi Fitriani</option>
                                    <option value='Dwi_P@mersifarma.com'>Dwi P</option>
                                    <option value='Egya_Prasadhana@mersifarma.com'>Egya Ryan Prasadhana</option>
                                    <option value='eka.acc@mersifarma.com'>Eka Chandra</option>
                                    <option value='Elseria_Purba@mersifarma.com'>Elseria Purba</option>
                                    <option value='Emilda_Carolina@mersifarma.com'>Emilda Carolina</option>
                                    <option value='Epo_Pringadi@mersifarma.com'>Epo Pringadi</option>
                                    <option value='Erma_Suryani@mersifarma.com'>Erma Suryani</option>
                                    <option value='Ervina_Fatin@mersifarma.com'>Ervina Nur Fatin</option>
                                    <option value='Evi_Hidayati@mersifarma.com'>Evi Nurul Hidayati</option>
                                    <option value='Fahmi_Wibowo@mersifarma.com'>Fahmi Riansyah Wibowo</option>
                                    <option value='Faizal.pro@mersifarma.com'>Faizal Ardhi</option>
                                    <option value='Fajar_Sidik@mersifarma.com'>Fajar Sidik</option>
                                    <option value='Fajri_Kurniawati@mersifarma.com'>Fajri Arum Kurniawati</option>
                                    <option value='Fakhriyadi_Azwardi@mersifarma.com'>Fakhriyadi Azwardi</option>
                                    <option value='Faradilla_Amelia@mersifarma.com'>Faradilla Amelia</option>
                                    <option value='Fariha_Hanum@mersifarma.com'>Fariha Hanum</option>
                                    <option value='Fathur_Rahman@mersifarma.com'>Fathur Rahman</option>
                                    <option value='Fenni_W@mersifarma.com'>Fenni Wulansari</option>
                                    <option value='Fikhi_Sepondra@mersifarma.com'>Fikhi Aprilia Sepondra</option>
                                    <option value='Fitria_Haryani@mersifarma.com'>Fitria Haryani</option>
                                    <option value='Fransisca_Valentine@mersifarma.com'>Fransisca Valentine</option>
                                    <option value='Fuji_S@mersifarma.com'>Fuji Stevany</option>
                                    <option value='Fuji_Sandy@mersifarma.com'>Fuji Fadhilla Sandy</option>
                                    <option value='Gede_Mahayoga@mersifarma.com'>Gede Adhi Mahayoga</option>
                                    <option value='Ghina_Lintangsari@mersifarma.com'>Ghina Lintangsari</option>
                                    <option value='Gisella_Gumilang@mersifarma.com'>Gisella Sartika Gumilang</option>
                                    <option value='Glenny_Yudhanto@mersifarma.com'>Glenny Yudhanto</option>
                                    <option value='Gunadi_B@mersifarma.com'>Gunadi Bratadiharja</option>
                                    <option value='Gunawan_S@mersifarma.com'>Gunawan Santoso</option>
                                    <option value='Haifa_Nurmahliati@mersifarma.com'>Haifa Nurmahliati</option>
                                    <option value='Haris_Indrajaya@mersifarma.com'>Haris Indrajaya</option>
                                    <option value='Harisman@mersifarma.com'>Harisman Harisman</option>
                                    <option value='Hariyadi_Tukiyono@mersifarma.com'>Hariyadi Tukiyono</option>
                                    <option value='Harry_Fauzi@mersifarma.com'>Harry Azhar Fauzi</option>
                                    <option value='Hedar.tek@mersifarma.com'>Hedar Mustajab</option>
                                    <option value='Heddy_Rachman@mersifarma.com'>Heddy Ferdina Rachman</option>
                                    <option value='Hendi_S@mersifarma.com'>Hendi Suhendro</option>
                                    <option value='Hendrikus_Sareng@mersifarma.com'>Hendrikus Seprino Sareng</option>
                                    <option value='Hendry_Hermanto@mersifarma.com'>Hendry Hermanto</option>
                                    <option value='Hendyk_H@mersifarma.com'>Hendyk Harriyanto</option>
                                    <option value='Hengki_Sutrisno@mersifarma.com'>Hengki Sutrisno</option>
                                    <option value='Henny_Koesnadhi@mersifarma.com'>Henny Ekawati Koesnadhi</option>
                                    <option value='Henry_P@mersifarma.com'>Henry Agung Prihatmojo</option>
                                    <option value='Heny_D@mersifarma.com'>Heny Dwijayanti</option>
                                    <option value='Herfin_B@mersifarma.com'>Herfin Budiawan</option>
                                    <option value='Heri_Kurniawan@mersifarma.com'>Heri Kurniawan</option>
                                    <option value='Heribertus_Sulistya@mersifarma.com'>Heribertus Wiku Sulistya</option>
                                    <option value='hermawan_widyaprasetya@mersifarma.com'>Hermawan Widyaprasetya</option>
                                    <option value='Hermawan_Widyaprasetya@mersifarma.com'>Hermawan Widyaprasetya</option>
                                    <option value='Hery_S@mersifarma.com'>Hery Setyawan</option>
                                    <option value='Hijri_Pridya@mersifarma.com'>Hijri Andini Pridya</option>
                                    <option value='Ifkliyatul_Ridhani@mersifarma.com'>Ifkliyatul Ridhani</option>
                                    <option value='Ihsanuddin_Imam@mersifarma.com'>Ihsanuddin Al Imam</option>
                                    <option value='Imam.ga@mersifarma.com'>Imam Prasetyo</option>
                                    <option value='Iman_Ruswandi@mersifarma.com'>Iman Ruswandi</option>
                                    <option value='Imran_Ramadhan@mersifarma.com'>Imran Ramadhan</option>
                                    <option value='Indah_Susanti@mersifarma.com'>Indah Susanti</option>
                                    <option value='Indriyani_Utami@mersifarma.com'>Indriyani Putri Utami</option>
                                    <option value='Inne_Purnamasari@mersifarma.com'>Inne Desi Purnamasari</option>
                                    <option value='Inneke_Permatasari@mersifarma.com'>Inneke Devi Permatasari</option>
                                    <option value='irah_meriana@mersifarma.com'>Irah Meriana</option>
                                    <option value='Irene_Murti@mersifarma.com'>Irene Intan Permata </option>
                                    <option value='Irene_Terasandjaja@mersifarma.com'>Irene Terasandjaja</option>
                                    <option value='Irlinda_Ardhianti@mersifarma.com'>Irlinda Fitraisyah Ardhianti</option>
                                    <option value='Irmawan_Sugiantoro@mersifarma.com'>Irmawan Sugiantoro</option>
                                    <option value='Irsalina_Nurani@mersifarma.com'>Irsalina Mutiara Nurani</option>
                                    <option value='Isharyanto_Sajiyo@mersifarma.com'>Isharyanto Sajiyo</option>
                                    <option value='Ismi_Nunkifidina@mersifarma.com'>Ismi Ayu Nunkifidina</option>
                                    <option value='Ita_Aryani@mersifarma.com'>Ita Aryani</option>
                                    <option value='Ita_C@mersifarma.com'>Ita Cholifah</option>
                                    <option value='Iwan_Sugiarpo@mersifarma.com'>Iwan Sugiarpo</option>
                                    <option value='Jaka_Waskita@mersifarma.com'>Jaka Waskita</option>
                                    <option value='jamaludin_rusdiandi@mersifarma.com'>Jamaludin Rusdiandi</option>
                                    <option value='janez_s@mersifarma.com'>Janez Sari</option>
                                    <option value='Japar_S@mersifarma.com'>Japar Sidik</option>
                                    <option value='Juliana_Maulina@mersifarma.com'>Juliana Maulina</option>
                                    <option value='Kasbandi@mersifarma.com'>Kasbandi Kasbandi</option>
                                    <option value='Khaerul_Umam@mersifarma.com'>Khaerul Umam</option>
                                    <option value='Khandika_Aditya@mersifarma.com'>Khandika Aditya</option>
                                    <option value='Khoirunnisa_Ramli@mersifarma.com'>Khoirunnisa Ramli</option>
                                    <option value='Kikik_P@mersifarma.com'>Kikik Henny Pricahyani</option>
                                    <option value='Kinanthi_Ariestyawati@mersifarma.com'>Kinanthi Ariestyawati</option>
                                    <option value='Konsultan_Pengemasan@mersifarma.com'>Konsultan Pengemasan</option>
                                    <option value='Kresna_Dwiputra@mersifarma.com'>Kresna Dwiputra</option>
                                    <option value='Kristiana_Nugraheni@mersifarma.com'>Kristiana Yanuar Nugraheni</option>
                                    <option value='kukuh_islami@mersifarma.com'>kukuh adli islami</option>
                                    <option value='Laila_Y@mersifarma.com'>Laila Yuniarti</option>
                                    <option value='Lamasse_Landa@mersifarma.com'>Lamasse Landa</option>
                                    <option value='Lia.ga@mersifarma.com'>Lia Yulianti</option>
                                    <option value='Lidya_Chyntia@mersifarma.com'>Lidya Ayu Chyntia</option>
                                    <option value='Lina_Khanifatulaila@mersifarma.com'>Lina Dewi Khanifatulaila</option>
                                    <option value='Lintang_wibowo@mersifarma.com'>Lintang Wibowo</option>
                                    <option value='Lisa.fin@mersifarma.com'>Lisa Rahmawati</option>
                                    <option value='Lutfi_Gifari@mersifarma.com'>Lutfi Ahmad Gifari</option>
                                    <option value='M_Naguib@mersifarma.com'>Muhammad Naguib</option>
                                    <option value='Maftuhatun_Alfani@mersifarma.com'>Maftuhatun Alfani</option>
                                    <option value='Marco_Notoprawiro@mersifarma.com'>Marco Notoprawiro</option>
                                    <option value='Mardana_N@mersifarma.com'>Mardana Naigolan</option>
                                    <option value='Maria_Ulfa@mersifarma.com'>Maria Ulfa</option>
                                    <option value='Marnala_S@mersifarma.com'>Marnala Siregar</option>
                                    <option value='Marsal_K@mersifarma.com'>Marsal Mochamad Kamil</option>
                                    <option value='Maxi_M@mersifarma.com'>Maxi M NULL</option>
                                    <option value='meida_lestari@mersifarma.com'>Meida Sri Lestari</option>
                                    <option value='Moch_Arofah@mersifarma.com'>Moch Arofah</option>
                                    <option value='Muh_Anwar@mersifarma.com'>Muh Anwar</option>
                                    <option value='Muh_Bakhtiar@mersifarma.com'>Muh Irham Bakhtiar</option>
                                    <option value='Muhamad.hr@mersifarma.com'>Muhamad Sopariandi</option>
                                    <option value='Muhamad_Akbar@mersifarma.com'>Muhamad Sabit Akbar</option>
                                    <option value='Muhamad_Lutfi@mersifarma.com'>Muhamad Lutfi</option>
                                    <option value='Muhamad_Sobri@mersifarma.com'>Muhamad Irfan Sobri</option>
                                    <option value='Muhammad_Abdillah@mersifarma.com'>Muhammad Hisan Abdillah</option>
                                    <option value='Muhammad_Batubara@mersifarma.com'>Muhammad Ansari BatuBara</option>
                                    <option value='Muhammad_Busram@mersifarma.com'>Muhammad Ikbar Busram</option>
                                    <option value='Muhammad_Hutomo@mersifarma.com'>Muhammad Agstriadi Hutomo</option>
                                    <option value='Muhammad_Ismail@mersifarma.com'>Muhammad Ismail</option>
                                    <option value='Muhammad_Ridwan@mersifarma.com'>Muhammad Ridwan</option>
                                    <option value='Muji_Widodo@mersifarma.com'>Muji Widodo</option>
                                    <option value='Muthia_Farina@mersifarma.com'>Muthia Farina</option>
                                    <option value='Mutia_Andriyani@mersifarma.com'>Mutia Andriyani</option>
                                    <option value='Mutiara_Nurazizah@mersifarma.com'>Mutiara Nurazizah</option>
                                    <option value='Nabila_Maretha@mersifarma.com'>Nabila Maretha</option>
                                    <option value='Nadia_Permatasari@mersifarma.com'>Nadia Putri Permatasari</option>
                                    <option value='Nadya_Simatupang@mersifarma.com'>Nadya Avri Naretha Simatupang</option>
                                    <option value='Nailil_Fadhilah@mersifarma.com'>Nailil Fadhilah</option>
                                    <option value='Nailul_H@mersifarma.com'>Nailul Hana</option>
                                    <option value='Naini_Astuti@mersifarma.com'>Naini Astuti</option>
                                    <option value='Nancy_Tangkelangi@mersifarma.com'>Nancy Tangkelangi</option>
                                    <option value='Nandang_Ginanjar@mersifarma.com'>Nandang Ginanjar</option>
                                    <option value='Nanik_Wahyuni@mersifarma.com'>Nanik Wahyuni</option>
                                    <option value='Nasrullah.its@mersifarma.com'>Nasrullah Arifin</option>
                                    <option value='Natalia_Ulina@mersifarma.com'>Natalia Ulina</option>
                                    <option value='Nelly_Afriyanti@mersifarma.com'>Nelly Afriyanti</option>
                                    <option value='Nepheline_Daryono@mersifarma.com'>Nepheline Daryono</option>
                                    <option value='Nia_Suwartiningsih@mersifarma.com'>Nia Suwartiningsih</option>
                                    <option value='Nindya_Pangestika@mersifarma.com'>Nindya Pangestika</option>
                                    <option value='Nirwana_A@mersifarma.com'>Nirwana Agustina</option>
                                    <option value='Noto_Kristanto@mersifarma.com'>Noto Kristanto (Printer Sharing)</option>
                                    <option value='Nova.pro@mersifarma.com'>Nova Nurlinda</option>
                                    <option value='Nova.reg@mersifarma.com'>Nova Oktaviani</option>
                                    <option value='Novi_Nensi@mersifarma.com'>Novi Septia Nensi</option>
                                    <option value='Novita_Roselina@mersifarma.com'>Novita Roselina</option>
                                    <option value='Nugroho_Susanto@mersifarma.com'>Nugroho Adhi Susanto</option>
                                    <option value='Nur.admjkt@mersifarma.com'>Nur Afrina</option>
                                    <option value='Nur.mkt@mersifarma.com'>Nur Aisyah</option>
                                    <option value='Nur.reg@mersifarma.com'>Nur Eki Meirisanti</option>
                                    <option value='Nur_Efendi@mersifarma.com'>Nur Efendi</option>
                                    <option value='Nur_Warham@mersifarma.com'>Nur Halim Warham</option>
                                    <option value='Nur_Zakia@mersifarma.com'>Nur Zakia</option>
                                    <option value='Nurlaili_Rahmawati@mersifarma.com'>Nurlaili Rahmawati</option>
                                    <option value='Nurlita_D@mersifarma.com'>Nurlita Desy</option>
                                    <option value='Nurul.ra@mersifarma.com'>R. R. Nurul Wardhani</option>
                                    <option value='Nurul_Hidayati@mersifarma.com'>Nurul Hidayati</option>
                                    <option value='Nyoman.Reniastuti@mersifarma.com'>Nyoman Reniastuti</option>
                                    <option value='Oktafiandono_Yuspin@mersifarma.com'>Oktafiandono Yuspin</option>
                                    <option value='Oktavia_Sari@mersifarma.com'>Oktavia Mustika Sari</option>
                                    <option value='Owen_Aliudin@mersifarma.com'>Owen Aliudin</option>
                                    <option value='Pahmi_Efendi@mersifarma.com'>Pahmi Pikri Efendi</option>
                                    <option value='Parmin_Samsuddin@mersifarma.com'>Parmin Samsuddin</option>
                                    <option value='Paulus_Kurnia@mersifarma.com'>Paulus Dedy Kurnia</option>
                                    <option value='Perdana.pcs@mersifarma.com'>Perdana Abdul Muis</option>
                                    <option value='Peronika_Karlina@mersifarma.com'>Peronika Karlina</option>
                                    <option value='Peter_Wijaya@mersifarma.com'>Peter Wijaya</option>
                                    <option value='Prakoso_Bahtera@mersifarma.com'>Prakoso Bangkit Bahtera</option>
                                    <option value='Prida_Asmarani@mersifarma.com'>Prida Asmarani</option>
                                    <option value='Puja_Priatna@mersifarma.com'>Puja Adi Priatna</option>
                                    <option value='Purwadi_Dwijodarmanto@mersifarma.com'>Purwadi Dwijodarmanto</option>
                                    <option value='Putri_Azkia@mersifarma.com'>Putri Azkia</option>
                                    <option value='Putri_Suci@mersifarma.com'>Putri Wulan Suci</option>
                                    <option value='Quratun_Aini@mersifarma.com'>Quratun Aini</option>
                                    <option value='Rafif_Rabbani@mersifarma.com'>Rafif Rabbani</option>
                                    <option value='Rahardjo_Purnomo@mersifarma.com'>Rahardjo Purnomo</option>
                                    <option value='Rahmatulloh@mersifarma.com'>Rahmatulloh Rahmatulloh</option>
                                    <option value='Rahmawati_Achmad@mersifarma.com'>Rahmawati Achmad</option>
                                    <option value='Raisa.qa@mersifarma.com'>Raisa Oktaviani</option>
                                    <option value='Rakha_Prasetyo@mersifarma.com'>Rakha Jati Prasetyo</option>
                                    <option value='Rama_P@mersifarma.com'>Rama Aria Pradipta</option>
                                    <option value='Ramawanti.fin@mersifarma.com'>Ramawati Ramawati</option>
                                    <option value='Ramli_Latief@mersifarma.com'>Ramli Maulana Latief</option>
                                    <option value='Raramiyati_Fitratunnisah@mersifarma.com'>Raramiyati Fitratunnisah</option>
                                    <option value='Ratnasari_Yeni@mersifarma.com'>Ratnasari Yeni</option>
                                    <option value='Ratu_Dewi@mersifarma.com'>Ratu Ayu Ngurah Ciptaning Dewi</option>
                                    <option value='Raw_MaterialPackaging@mersifarma.com'>Ani Budiartini</option>
                                    <option value='Recky_Noviansyah@mersifarma.com'>Recky Noviansyah</option>
                                    <option value='Registrasi_Support@mersifarma.com'>Registrasi Support</option>
                                    <option value='Reni.fin@mersifarma.com'>Reni Purwanti</option>
                                    <option value='reymond_i@mersifarma.com'>Reymond Inmar</option>
                                    <option value='Reza.Acc@mersifarma.com'>Reza Fakhrurizal</option>
                                    <option value='Reza_Gusfi@mersifarma.com'>Reza Aulia Gusfi</option>
                                    <option value='Rezky_Yunus@mersifarma.com'>Rezky Raudah Yunus</option>
                                    <option value='Ria.hr@mersifarma.com'>Ria Atlawati</option>
                                    <option value='Ria_Salma@mersifarma.com'>Ria Putri Salma</option>
                                    <option value='Riadi_Anggoro@mersifarma.com'>Riadi Anggoro</option>
                                    <option value='Riaswati.Mkt@mersifarma.com'>Riaswati Riaswati</option>
                                    <option value='Ricky_Kurniawan@mersifarma.com'>Ricky Kurniawan</option>
                                    <option value='Rifani_Wilton@mersifarma.com'>Rifani Fauzia Wilton</option>
                                    <option value='Rina_E@mersifarma.com'>Rina Elita</option>
                                    <option value='Ririn_O@mersifarma.com'>Ririn Octaviani</option>
                                    <option value='Risal.qa@mersifarma.com'>Risal Fauzi</option>
                                    <option value='riska_rosida@mersifarma.com'>Riska Rosida</option>
                                    <option value='Riski_Solehati@mersifarma.com'>Riski Solehati</option>
                                    <option value='Riza_I@mersifarma.com'>Riza Hidari Irava</option>
                                    <option value='Rizal_Marie@mersifarma.com'>Rizal NULL</option>
                                    <option value='Rizki.Acc@mersifarma.com'>Rizki Mapaluta</option>
                                    <option value='Rizkia_Hasyyati@mersifarma.com'>Rizkia Hasyyati</option>
                                    <option value='Rizky_Ahmad@mersifarma.com'>Rizky Yuliandra Ahmad</option>
                                    <option value='rizky_p@mersifarma.com'>Rizky P</option>
                                    <option value='Rossi_Darmayanti@mersifarma.com'>Rossi Darmayanti</option>
                                    <option value='Rudi_Werdana@mersifarma.com'>Rudi Werdana</option>
                                    <option value='Rullie_K@mersifarma.com'>Rullie Kurniawan</option>
                                    <option value='Rusdiana@mersifarma.com'>Rusdiana Rusdiana</option>
                                    <option value='Ryska_Adam@mersifarma.com'>Ryska Meyliasari Adam</option>
                                    <option value='Saffana_Haniyya@mersifarma.com'>Saffana Haniyya</option>
                                    <option value='Safira_Cahyaningrum@mersifarma.com'>Safira Cahyaningrum</option>
                                    <option value='Satrio_Hutomo@mersifarma.com'>Satrio Ponco Hutomo</option>
                                    <option value='satrioyuliarto@mersifarma.com'>Satrio Yuliarto</option>
                                    <option value='selvi_labkimia@mersifarma.com'>Selvi Laboratorium Kimia</option>
                                    <option value='selvi_labmikro@mersifarma.com'>Selvi Laboratorium Mikrobiologi</option>
                                    <option value='selvi_qa@mersifarma.com'>Selvi Quality Assurance</option>
                                    <option value='selvi_qcipc@mersifarma.com'>Selvi Quality Control â€“ In Process Control</option>
                                    <option value='selvi_qcoffice@mersifarma.com'>Selvi QC Office</option>
                                    <option value='selvi_ts@mersifarma.com'>Selvi Techical Service</option>
                                    <option value='Seng_Kimsour@mersifarma.com'>Seng Kimsour</option>
                                    <option value='Septia_Wandari@mersifarma.com'>Septia Fanny Wandari</option>
                                    <option value='Septian_Setiadi@mersifarma.com'>Septian Puguh Setiadi</option>
                                    <option value='Sharfina_Wulandari@mersifarma.com'>Sharfina Amalia Wulandari</option>
                                    <option value='Shavira_Rahayu@mersifarma.com'>Shavira Sri Rahayu</option>
                                    <option value='Shevy@mersifarma.com'>Shevy Shevy</option>
                                    <option value='Shindy@mersifarma.com'>Shindy NULL</option>
                                    <option value='Shinta_Kusuma@mersifarma.com'>Shinta Widya Kusuma</option>
                                    <option value='Shintiya_Devi@mersifarma.com'>Shintiya Devi</option>
                                    <option value='sigit_u@mersifarma.com'>Sigit Utomo</option>
                                    <option value='Sigit_U@mersifarma.com'>Sigit Utomo</option>
                                    <option value='Silvia_Desky@mersifarma.com'>Silvia Mentari Desky</option>
                                    <option value='Siska.rd@mersifarma.com'>Siska Novianti</option>
                                    <option value='Sista_Wijaya@mersifarma.com'>Sista Dyah Wijaya</option>
                                    <option value='Siswanto@mersifarma.com'>Siswanto Siswanto</option>
                                    <option value='Siswanto_Karsomiharjo@mersifarma.com'>Siswanto Karsomiharjo</option>
                                    <option value='Siti_C@mersifarma.com'>Siti Chairani</option>
                                    <option value='Siti_Fuadi@mersifarma.com'>Siti Sarah Fuadi</option>
                                    <option value='Slamet_Risdiyanto@mersifarma.com'>Slamet Risdiyanto</option>
                                    <option value='sofian_sabeni@mersifarma.com'>Sofian Sabeni</option>
                                    <option value='Stefanus_Y@mersifarma.com'>Stefanus Yagianto</option>
                                    <option value='Suhendra_Siu@mersifarma.com'>Sim Eng Siu Suhendra</option>
                                    <option value='Suprianto@mersifarma.com'>Suprianto Suprianto</option>
                                    <option value='Suryo.fin@mersifarma.com'>Suryo Baskoro</option>
                                    <option value='Suryo.Hutomo@mersifarma.com'>Suryo Hutomo</option>
                                    <option value='Susri_Masyatun@mersifarma.com'>Susri Masyatun</option>
                                    <option value='Sutresna@mersifarma.com'>Sutresna Sutresna</option>
                                    <option value='Swaesti.mkt@mersifarma.com'>Swaesti Praba Hardanti</option>
                                    <option value='Syahril.pro@mersifarma.com'>Syahril Syahril</option>
                                    <option value='Syahrullah@mersifarma.com'>Syahrullah Syahrullah</option>
                                    <option value='Syifa_fariha@mersifarma.com'>Syifa Fariha</option>
                                    <option value='Tegar_Setyawan@mersifarma.com'>Tegar Hary Setyawan</option>
                                    <option value='Teguh_Putra@mersifarma.com'>Teguh Permana Putra</option>
                                    <option value='Tengku_P@mersifarma.com'>Tengku Kemal Pasha</option>
                                    <option value='Thania_Haerunisya@mersifarma.com'>Thania Haerunisya</option>
                                    <option value='Thomas_Katana@mersifarma.com'>Thomas Candra Katana</option>
                                    <option value='Tia_Aprilia@mersifarma.com'>Tia Eka Aprilia</option>
                                    <option value='Tika_Febrianti@mersifarma.com'>Tika Febrianti</option>
                                    <option value='tirtokusnadi@mersifarma.com'>Tirto Kusnadi</option>
                                    <option value='Totok_Pribadi@mersifarma.com'>Totok Ananto Pribadi</option>
                                    <option value='Tri.fin@mersifarma.com'>Tri Sarvina</option>
                                    <option value='Tri.mkt@mersifarma.com'>Tri Yuniardi</option>
                                    <option value='Tri_Astuti@mersifarma.com'>Tri Astuti</option>
                                    <option value='Trias_Salma@mersifarma.com'>Trias Salma</option>
                                    <option value='Triyanto.hr@mersifarma.com'>Triyanto Respatitomo</option>
                                    <option value='Ujang.tek@mersifarma.com'>Ujang Roni</option>
                                    <option value='Ursula_I@mersifarma.com'>Ursula Dhanie Indhiati</option>
                                    <option value='Utami_M@mersifarma.com'>Utami Mayangsari</option>
                                    <option value='Utawati_Daryoto@mersifarma.com'>Utawati Daryoto</option>
                                    <option value='Validasi_Komputerisasi@mersifarma.com'>Ammar Abdul Ghoffar</option>
                                    <option value='Vectoria_Trimuryani@mersifarma.com'>Vectoria Ani Trimuryani</option>
                                    <option value='Veronica_Putri@mersifarma.com'>Veronica Atik Widyanti Putri</option>
                                    <option value='Virgina.acc@mersifarma.com'>Virgina Septiani Bangun</option>
                                    <option value='Wahyu_Adiningsih@mersifarma.com'>Wahyu Adiningsih</option>
                                    <option value='Wahyu_Juniharto@mersifarma.com'>Wahyu Nixon Juniharto</option>
                                    <option value='Wahyu_Widyawati@mersifarma.com'>Wahyu Suci Widyawati</option>
                                    <option value='wardoyo@mersifarma.com'>Wardoyo Wardoyo</option>
                                    <option value='Wayan_Yudhistira@mersifarma.com'>I Wayan Arya Yudhistira</option>
                                    <option value='Wening@mersifarma.com'>Wening Wening</option>
                                    <option value='Widha_R@mersifarma.com'>Widha Rikawati</option>
                                    <option value='Widi_Desti@mersifarma.com'>Widi Novella Desti</option>
                                    <option value='Widia_Pramita@mersifarma.com'>Widia Septiany Pramita</option>
                                    <option value='Widiyati_Suyoto@mersifarma.com'>Widiyati Suyoto</option>
                                    <option value='Wildani_Juhana@mersifarma.com'>Wildani Juhana</option>
                                    <option value='Windy_Rachmisyah@mersifarma.com'>Windy Rachmisyah</option>
                                    <option value='Wine_Septika@mersifarma.com'>Wine Septika</option>
                                    <option value='Wiwik_Dwiatun@mersifarma.com'>Wiwik Dwiatun</option>
                                    <option value='Yayi_Hidayat@mersifarma.com'>Yayi Hidayat</option>
                                    <option value='Yesi_Septiani@mersifarma.com'>Yesi Septiani</option>
                                    <option value='Yessika_Anelia@mersifarma.com'>Yessika Anelia</option>
                                    <option value='Yoga_Apriliano@mersifarma.com'>Yoga Ridho Apriliano</option>
                                    <option value='Yoga_Putra@mersifarma.com'>Yoga Adi Putra</option>
                                    <option value='Yogi_Kurniawan@mersifarma.com'>Yogi Kurniawan</option>
                                    <option value='Yudha_Tripriawan@mersifarma.com'>Yudha Wahyu Tripriawan</option>
                                    <option value='Yudi_Andiyana@mersifarma.com'>Yudi Andiyana</option>
                                    <option value='Yugi.pcs@mersifarma.com'>Yugi Dwi Anggoro</option>
                                    <option value='Yuli_H@mersifarma.com'>Yuli Handayani</option>
                                    <option value='Yuliana.mkt@mersifarma.com'>Yuliana Yuliana</option>
                                    <option value='Yuniarto_Lukito@mersifarma.com'>Yuniarto Lukito</option>
                                    <option value='yusuf_r@mersifarma.com'>Yusuf Randy</option>
                                    <option value='Yusup_Permana@mersifarma.com'>Yusup Yuda Permana</option>
                                    <option value='Yuzark_Gumintang@mersifarma.com'>Yuzark Gumintang</option>
                                    <option value='zainul_h@mersifarma.com'>Zainul Hakim</option>
                                    <option value='Zulfa_Assadiyah@mersifarma.com'>Zulfa Hanifah Assadiyah</option>
                                    <option value='Zulfa_Rozi@mersifarma.com'>Zulfa Rozi</option>
                                    <option value='Zulfiqar_Natsir@mersifarma.com'>Zulfiqar Natsir</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary mr-2">Save</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Card-->
</div>
</div>
</div>
<!--end::Container-->
</div>
<!--end::Entry-->
</div>
<!--end::Content-->

<!--begin::Footer-->
<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted font-weight-bold mr-2">2023© Mersifarma Tirmaku Mercusana</span>
        </div>
        <!--end::Copyright-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::Main-->
<!-- begin::User Panel-->
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label" style="background-image:url('assets/media/users/300_21.jpg')"></div>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                    <?= $_SESSION['usr_firstname'] . ' ' . $_SESSION['usr_lastname'] ?>
                </a>
                <div class="text-muted mt-1">
                    <?= $_SESSION['usr_position'] ?>
                </div>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
                        <span class="navi-link p-0 pb-2">
                            <span class="navi-icon mr-1">
                                <span class="svg-icon svg-icon-lg svg-icon-primary">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                            </span>
                            <span class="navi-text text-muted text-hover-primary"><?= $_SESSION['usr_email'] ?></span>
                        </span>
                    </a>
                    <a href="controller/common.php?action=logout" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">
                        Sign Out
                    </a>
                </div>
            </div>
        </div>
        <!--end::Header-->
    </div>
    <!--end::Content-->
</div>
<!-- end::User Panel-->
<script>
    $(document).ready(function() {
        function handleToggle() {
            var target = $(this).data('target');
            $('.' + target + '-input').toggle(this.checked);
        }

        $('.realtime-input, .accelerated-input, .ongoing-input').hide();

        $('.toggle-input').change(handleToggle);

        $('.toggle-input').each(handleToggle);
    });
</script>
<script>
    var KTBootstrapDatepicker = function() {
        var arrows;
        if (KTUtil.isRTL()) {
            arrows = {
                leftArrow: '<i class="fa-solid fa-angle-right"></i>',
                rightArrow: '<i class="fa-solid fa-angle-left"></i>'
            }
        } else {
            arrows = {
                leftArrow: '<i class="fa-solid fa-angle-left"></i>',
                rightArrow: '<i class="fa-solid fa-angle-right"></i>'
            }
        }

        var demos = function() {
            $('#mfg_date').datepicker({
                rtl: KTUtil.isRTL(),
                todayHighlight: true,
                orientation: "bottom left",
                templates: arrows,
                format: "yyyy-mm-dd"
            });
            $('#exp_date').datepicker({
                rtl: KTUtil.isRTL(),
                todayHighlight: true,
                orientation: "bottom left",
                templates: arrows,
                format: "yyyy-mm-dd"
            });
            $('#sample_date').datepicker({
                rtl: KTUtil.isRTL(),
                todayHighlight: true,
                orientation: "bottom left",
                templates: arrows,
                format: "yyyy-mm-dd"
            });

            $('#emails').select2({
                placeholder: "Select an email",
            });
        }

        return {
            init: function() {
                demos();
            }
        };
    }();

    KTBootstrapDatepicker.init();
</script>
</body>

</html>