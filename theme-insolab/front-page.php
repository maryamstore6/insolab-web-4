<?php
/**
 * Halaman utama InsoLab.
 *
 * @package InsoLab
 */

get_header();

/* ── Data ── */
$hero_id  = (int) get_theme_mod('insolab_hero_id', 43);
$hero_img = $hero_id ? wp_get_attachment_image($hero_id, 'insolab-hero', false, [
    'alt'     => __('Custom insole moulding kit with footprint impressions', 'insolab'),
    'loading' => 'eager',
    'fetchpriority' => 'high',
]) : '';

$vid_adult = get_theme_mod('insolab_vid_adult', 45);
$vid_kid   = get_theme_mod('insolab_vid_kid', 46);
$vid_adult_url = $vid_adult ? wp_get_attachment_url($vid_adult) : '';
$vid_kid_url   = $vid_kid ? wp_get_attachment_url($vid_kid) : '';

$hero_vid_id  = (int) get_theme_mod('insolab_hero_vid', 53);
$hero_post_id = (int) get_theme_mod('insolab_hero_poster', 54);
$hero_vid_url = $hero_vid_id ? wp_get_attachment_url($hero_vid_id) : '';
$hero_poster  = $hero_post_id ? wp_get_attachment_image_url($hero_post_id, 'full') : '';

$wa = insolab_wa_url();
?>

<!-- ══════════ HERO (video) ══════════ -->
<section class="hero hero-video" id="utama">
  <div class="hero-bg" aria-hidden="true"></div>
  <div class="hero-grain" aria-hidden="true"></div>
  <div class="wrap hero-grid" data-reveal>

    <div class="hero-copy">
      <div class="hero-eyebrow">
        <span class="ln"></span>
        <span class="idx">01</span>
        <span class="tx"><?php esc_html_e('Makmal InsoLab', 'insolab'); ?></span>
      </div>
      <h1><?php esc_html_e('Kaki penat berdiri lama?', 'insolab'); ?><br><em><?php esc_html_e('Insole dibuat dari acuan kaki anda.', 'insolab'); ?></em></h1>
      <p class="hero-tagline"><?php esc_html_e('Custom Insoles, Just For You.', 'insolab'); ?></p>
      <p class="hero-lead"><?php esc_html_e('Kami pos Kit Acuan terus ke rumah anda. Ambil masa 5 minit untuk buat acuan, pos balik percuma — dan Makmal InsoLab akan bina insole mengikut bentuk kaki anda sendiri. Tanpa perlu keluar rumah.', 'insolab'); ?></p>
      <div class="hero-btns">
        <a class="btn btn-lg btn-wa" href="<?php echo esc_url($wa); ?>" target="_blank" rel="noopener"><?php echo insolab_icon('wa'); ?> <?php esc_html_e('Pesan Kit Acuan Sekarang', 'insolab'); ?></a>
        <a class="btn btn-lg btn-line" href="#video"><?php esc_html_e('Tengok Cara Ia Berfungsi', 'insolab'); ?></a>
      </div>
      <div class="hero-chips">
        <span class="hero-chip"><?php echo insolab_icon('shield'); ?> <?php esc_html_e('Jaminan 180 hari', 'insolab'); ?></span>
        <span class="hero-chip"><?php echo insolab_icon('truck'); ?> <?php esc_html_e('Pos percuma seluruh Malaysia', 'insolab'); ?></span>
        <span class="hero-chip"><?php echo insolab_icon('award'); ?> <?php esc_html_e('Kit RM20 — dikreditkan', 'insolab'); ?></span>
        <span class="hero-chip"><?php echo insolab_icon('check'); ?> <?php esc_html_e('Siap 16–20 hari', 'insolab'); ?></span>
      </div>
    </div>

    <div class="hero-visual">
      <div class="hero-phone" id="heroPhone" data-speed="0.03">
        <?php if ($hero_vid_url) : ?>
          <video id="heroVideo"
                 src="<?php echo esc_url($hero_vid_url); ?>"
                 <?php if ($hero_poster) : ?>poster="<?php echo esc_url($hero_poster); ?>"<?php endif; ?>
                 muted playsinline loop preload="metadata" aria-label="<?php esc_attr_e('Cara guna kit scan InsoLab', 'insolab'); ?>"></video>
        <?php endif; ?>
        <div class="hero-phone-label">
          <span class="tag"><?php esc_html_e('Kanak-kanak', 'insolab'); ?></span>
          <h4><?php esc_html_e('Bantuan orang dewasa', 'insolab'); ?></h4>
        </div>
        <div class="hero-phone-badge">
          <span class="pulse"></span>
          <?php esc_html_e('Cara guna kit', 'insolab'); ?>
        </div>
      </div>

      <div class="hero-float hero-float-2" data-speed="0.08">
        <div class="n">4.9/5</div>
        <div class="l"><?php esc_html_e('penilaian pelanggan', 'insolab'); ?></div>
      </div>
    </div>

  </div>
  <div class="hero-cue" aria-hidden="true">
    <span><?php esc_html_e('Skrol', 'insolab'); ?></span>
    <span class="bar"></span>
  </div>
</section>

<!-- ══════════ STATISTIK ══════════ -->
<div class="stats">
  <div class="wrap stats-grid" data-reveal>
    <div class="stat"><div class="n">2,400+</div><div class="l"><?php esc_html_e('Pasang dihantar', 'insolab'); ?></div></div>
    <div class="stat"><div class="n">16&ndash;20</div><div class="l"><?php esc_html_e('Hari siap', 'insolab'); ?></div></div>
    <div class="stat"><div class="n">180</div><div class="l"><?php esc_html_e('Hari jaminan', 'insolab'); ?></div></div>
    <div class="stat"><div class="n">4.9/5</div><div class="l"><?php esc_html_e('Penilaian purata', 'insolab'); ?></div></div>
  </div>
</div>

<!-- ══════════ MARQUEE TRUST ══════════ -->
<div class="marquee" aria-hidden="true">
  <div class="marquee-track">
    <?php
    $items = [
        __('Jaminan 180 hari', 'insolab'),
        __('Penghantaran percuma seluruh Malaysia', 'insolab'),
        __('Kit scan RM20 — dikreditkan', 'insolab'),
        __('2,400+ pasang dihantar', 'insolab'),
        __('Penilaian 4.9/5', 'insolab'),
        __('Custom fit dari acuan kaki anda', 'insolab'),
        __('Siap 16–20 hari', 'insolab'),
    ];
    for ($r = 0; $r < 2; $r++) {
        foreach ($items as $it) {
            echo '<span class="mq-item">' . insolab_icon('check') . esc_html($it) . '</span>';
        }
    }
    ?>
  </div>
</div>

<!-- ══════════ PRODUK ══════════ -->
<section class="sec sec-gray" id="produk">
  <div class="wrap" data-reveal>
    <div class="sec-head" data-num="02">
      <span class="idx">02</span>
      <p class="kicker"><?php esc_html_e('Our Insoles', 'insolab'); ?></p>
      <h2><?php esc_html_e('Dua jenis. Satu cara — dibuat dari kaki anda.', 'insolab'); ?></h2>
      <p><?php esc_html_e('Untuk hari yang panjang, atau langkah yang laju. Kedua-duanya dibina dari acuan kaki anda.', 'insolab'); ?></p>
    </div>
    <?php
    if (shortcode_exists('products')) {
        echo do_shortcode('[products limit="2" columns="2" orderby="date" order="DESC"]');
        echo '<div class="text-center" style="margin-top:42px">';
        $shop = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/');
        echo '<a class="btn btn-ghost" href="' . esc_url($shop) . '">' . esc_html__('Lihat semua insole', 'insolab') . '</a></div>';
    }
    ?>
  </div>
</section>

<!-- ══════════ BANTUAN PILIH (kuiz ringkas) ══════════ -->
<section class="sec" id="pilih" data-num="03">
  <div class="wrap" data-reveal>
    <div class="sec-head" data-num="03">
      <span class="idx">03</span>
      <p class="kicker"><?php esc_html_e('Tak pasti nak pilih yang mana?', 'insolab'); ?></p>
      <h2><?php esc_html_e('Dua soalan, satu jawapan', 'insolab'); ?></h2>
      <p><?php esc_html_e('Bagitahu kami sedikit tentang hari anda — kami cadangkan insole yang sesuai.', 'insolab'); ?></p>
    </div>
    <div class="quiz-grid">
      <a class="quiz-card" target="_blank" rel="noopener"
         href="<?php echo esc_url(insolab_wa_url('Hi InsoLab, saya berdiri/lasak lebih 4 jam sehari. Insole mana sesuai untuk saya?')); ?>">
        <div class="ico"><?php echo insolab_icon('shield'); ?></div>
        <h4><?php esc_html_e('Saya berdiri lama setiap hari', 'insolab'); ?></h4>
        <p><?php esc_html_e('Jaga kedai, mengajar, kilang, penghantaran — 4 jam atau lebih.', 'insolab'); ?></p>
        <span class="quiz-cta"><?php esc_html_e('Cadang Everyday', 'insolab'); ?> &rarr;</span>
      </a>
      <a class="quiz-card" target="_blank" rel="noopener"
         href="<?php echo esc_url(insolab_wa_url('Hi InsoLab, saya aktif bersukan (lari/gym/hiking). Insole mana sesuai untuk saya?')); ?>">
        <div class="ico"><?php echo insolab_icon('motion'); ?></div>
        <h4><?php esc_html_e('Saya aktif bersukan', 'insolab'); ?></h4>
        <p><?php esc_html_e('Lari, gym, hiking, bola sepak atau sukan lain.', 'insolab'); ?></p>
        <span class="quiz-cta"><?php esc_html_e('Cadang Sport', 'insolab'); ?> &rarr;</span>
      </a>
    </div>
    <p class="hint"><?php esc_html_e('Klik pilihan — kami balas di WhatsApp dengan cadangan & harga.', 'insolab'); ?></p>
  </div>
</section>

<!-- ══════════ DI MANA RASA TIDAK SELESA (gaya Upstep) ══════════ -->
<section class="sec" id="sakit" data-num="04">
  <div class="wrap" data-reveal>
    <div class="sec-head" data-num="04">
      <span class="idx">04</span>
      <p class="kicker"><?php esc_html_e('Kenali kaki anda', 'insolab'); ?></p>
      <h2><?php esc_html_e('Kalau kaki anda selalu penat, itu bukan perkara biasa.', 'insolab'); ?></h2>
      <p><?php esc_html_e('Klik kawasan yang paling mengganggu anda — kami kongsikan bagaimana insole khas membantu.', 'insolab'); ?></p>
    </div>
    <div class="pain-grid">
      <?php
      $pains = [
          ['tumit',  __('Tumit', 'insolab'), __('Sakit menusuk bila bangun pagi atau selepas duduk lama.', 'insolab')],
          ['lengkung', __('Lengkung kaki', 'insolab'), __('Rasa panas dan letih di tengah kaki.', 'insolab')],
          ['bebola',  __('Bebola kaki', 'insolab'), __('Macam ada batu di bawah kaki bila berjalan.', 'insolab')],
          ['ibu jari', __('Ibu jari', 'insolab'), __('Bengkak atau tidak selesa di sendi ibu jari.', 'insolab')],
          ['lutut',  __('Lutut & pinggul', 'insolab'), __('Beban naik ke atas sebab tapak kaki tak seimbang.', 'insolab')],
          ['penat',  __('Penat seharian', 'insolab'), __('Kaki berat & letih walaupun kerja biasa.', 'insolab')],
      ];
      foreach ($pains as $i => $pn) : ?>
        <a class="pain-card" target="_blank" rel="noopener"
           href="<?php echo esc_url(insolab_wa_url('Hi InsoLab, saya rasa tidak selesa di bahagian ' . $pn[0] . '. Boleh cadangkan insole yang sesuai?')); ?>"
           data-reveal data-delay="<?php echo esc_attr($i * 60); ?>">
          <span class="pain-dot"></span>
          <h4><?php echo esc_html($pn[1]); ?></h4>
          <p><?php echo esc_html($pn[2]); ?></p>
        </a>
      <?php endforeach; ?>
    </div>
    <div class="pain-note">
      <strong><?php esc_html_e('Kenapa insole rak gagal?', 'insolab'); ?></strong>
      <p><?php esc_html_e('Sebab ia dibuat untuk "kaki purata" — bukan kaki anda. Ia sokong di tempat yang salah, dan tinggalkan tempat yang paling perlukan sokongan. Rasa lega cuma sekejap.', 'insolab'); ?></p>
    </div>
  </div>
</section>

<!-- ══════════ KENAPA INSOLAB ══════════ -->
<section class="sec sec-dark" id="kenapa">
  <div class="wrap" data-reveal>
    <div class="sec-head">
      <span class="idx">05</span>
      <p class="kicker"><?php esc_html_e('Why InsoLab', 'insolab'); ?></p>
      <h2><?php esc_html_e('Built on assessment, not guesswork', 'insolab'); ?></h2>
      <p><?php esc_html_e('Kebanyakan insole dijual ikut saiz kasut. Kami mula dengan kaki anda sendiri — diukur, dibaca dan dibina.', 'insolab'); ?></p>
    </div>
    <div class="grid4">
      <?php
      $feat = [
          ['scan',   __('Analisa di Makmal InsoLab', 'insolab'), __('Setiap acuan diperiksa satu per satu — lengkung, taburan tekanan, bentuk tumit.', 'insolab')],
          ['layers', __('Dibina Khas Untuk Anda', 'insolab'), __('Bukan dipilih dari rak ikut saiz. Dibentuk ikut acuan kaki anda sendiri.', 'insolab')],
          ['award',  __('Material Premium', 'insolab'), __('Ringan, bernafas dan tahan lama — sedia untuk pemakaian harian.', 'insolab')],
          ['motion', __('Pergerakan Lebih Selesa', 'insolab'), __('Menyokong postur dan membantu mengurangkan ketidakselesaan anda.', 'insolab')],
      ];
      foreach ($feat as $i => $f) : ?>
        <div class="card-dark" data-reveal data-delay="<?php echo esc_attr($i * 90); ?>">
          <div class="ico"><?php echo insolab_icon($f[0]); ?></div>
          <h4><?php echo esc_html($f[1]); ?></h4>
          <p><?php echo esc_html($f[2]); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══════════ PROSES ══════════ -->
<section class="sec" id="proses" data-num="06">
  <div class="wrap proses" data-reveal>
    <div class="sec-head" data-num="06">
      <p class="kicker"><?php esc_html_e('Our Process', 'insolab'); ?></p>
      <h2><?php esc_html_e('Four steps, from your first scan to your first step', 'insolab'); ?></h2>
      <p><?php esc_html_e('Semuanya bermula di rumah. Tiada temujanji diperlukan untuk mula.', 'insolab'); ?></p>
    </div>
    <?php
    $steps = [
        [__('Pesan Kit Acuan', 'insolab'), __('Pilih insole anda, buat pesanan. Kit Acuan tiba di pintu rumah dalam 2–3 hari bekerja, lengkap dengan panduan bergambar.', 'insolab')],
        [__('Buat Acuan — 5 Minit', 'insolab'), __('Tekan kaki anda ke dalam busa acuan. Orang dewasa boleh berdiri terus; kanak-kanak dibantu orang dewasa.', 'insolab')],
        [__('Pos Balik — Percuma', 'insolab'), __('Masukkan kit ke dalam kotak asal, tampal label prabayar yang kami sediakan. Anda tidak bayar sesen.', 'insolab')],
        [__('Insole Siap — 16–20 Hari', 'insolab'), __('Makmal kami bina insole anda, kemudian hantar terus ke rumah. Cuba 180 hari — kalau tidak puas, wang dipulangkan.', 'insolab')],
    ];
    foreach ($steps as $i => $s) : ?>
      <div class="prow">
        <div class="pnum"><?php echo esc_html(sprintf('%02d', $i + 1)); ?></div>
        <div>
          <h3><?php echo esc_html($s[0]); ?></h3>
          <p><?php echo esc_html($s[1]); ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php if ($vid_adult_url || $vid_kid_url) : ?>
<!-- ══════════ VIDEO ══════════ -->
<section class="sec sec-gray" id="video">
  <div class="wrap" data-reveal>
    <div class="sec-head">
      <p class="kicker"><?php esc_html_e('The Scan Kit In Action', 'insolab'); ?></p>
      <h2><?php esc_html_e('Five minutes at home. That&rsquo;s all it takes.', 'insolab'); ?></h2>
      <p><?php esc_html_e('Kit anda tiba dengan semua yang diperlukan. Tekan kaki ke dalam busa acuan, pos semula, dan kami uruskan selebihnya.', 'insolab'); ?></p>
    </div>
    <div class="vid-grid">
      <?php if ($vid_adult_url) : ?>
      <div class="vid" data-reveal data-delay="80">
        <video src="<?php echo esc_url($vid_adult_url); ?>" muted playsinline loop preload="metadata"></video>
        <div class="vid-label">
          <span class="tag"><?php esc_html_e('Dewasa', 'insolab'); ?></span>
          <h4><?php esc_html_e('Berdiri dan tekan', 'insolab'); ?></h4>
          <p><?php esc_html_e('Orang dewasa boleh terus berdiri di atas busa — berat penuh, bacaan paling tepat.', 'insolab'); ?></p>
        </div>
      </div>
      <?php endif; ?>
      <?php if ($vid_kid_url) : ?>
      <div class="vid" data-reveal data-delay="200">
        <video src="<?php echo esc_url($vid_kid_url); ?>" muted playsinline loop preload="metadata"></video>
        <div class="vid-label">
          <span class="tag"><?php esc_html_e('Kanak-kanak', 'insolab'); ?></span>
          <h4><?php esc_html_e('Bantuan orang dewasa', 'insolab'); ?></h4>
          <p><?php esc_html_e('Untuk kanak-kanak, orang dewasa hanya tekan kaki dengan lembut — acuan bersih, dalam beberapa saat.', 'insolab'); ?></p>
        </div>
      </div>
      <?php endif; ?>
    </div>
    <p class="hint"><?php esc_html_e('Video dimainkan automatik apabila masuk ke skrin.', 'insolab'); ?></p>
  </div>
</section>
<?php endif; ?>

<!-- ══════════ TESTIMONI ══════════ -->
<section class="sec sec-gray" id="ulasan">
  <div class="wrap" data-reveal>
    <div class="sec-head">
      <p class="kicker"><?php esc_html_e('Reviews', 'insolab'); ?></p>
      <h2><?php esc_html_e('Apa kata pelanggan kami', 'insolab'); ?></h2>
    </div>
    <div class="tgrid">
      <?php
      $rev = [
          ['Nurul Aisyah', 'Melaka', 'Berdiri 9 jam sehari jaga kedai. Sejak pakai insole InsoLab, sakit tumit petang tu hilang. Kit pun senang guna.'],
          ['Hafiz Rahman', 'Kuala Lumpur', 'Kerja tapak projek, kasut safety. Insole ni buat kaki rasa lega lepas balik kerja. Siap 8 hari je.'],
          ['Siti Mariam', 'Johor Bahru', 'Anak saya 9 tahun, kaki selalu lenguh masa PJ. Cikgu pun perasan dia jalan lebih tegak sekarang.'],
      ];
      foreach ($rev as $i => $r) :
          $initial = mb_strtoupper(mb_substr($r[0], 0, 1)); ?>
        <div class="tcard" data-reveal data-delay="<?php echo esc_attr($i * 90); ?>">
          <div class="stars">
            <?php for ($s = 0; $s < 5; $s++) { echo insolab_icon('star'); } ?>
          </div>
          <p><?php echo esc_html($r[2]); ?></p>
          <div class="twho">
            <div class="tavatar"><?php echo esc_html($initial); ?></div>
            <div>
              <div class="nm"><?php echo esc_html($r[0]); ?></div>
              <div class="ct"><?php echo esc_html($r[1]); ?></div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══════════ PAKAR (gaya Upstep: the professionals behind) ══════════ -->
<section class="sec sec-dark" id="pakar">
  <div class="wrap" data-reveal>
    <div class="sec-head">
      <span class="idx">06</span>
      <p class="kicker"><?php esc_html_e('Di belakang setiap pasang', 'insolab'); ?></p>
      <h2><?php esc_html_e('Bukan mesin. Bukan saiz rak.', 'insolab'); ?></h2>
      <p><?php esc_html_e('Setiap acuan dibaca dan setiap insole dibentuk dengan tangan — oleh mereka yang faham kaki.', 'insolab'); ?></p>
    </div>
    <div class="grid3">
      <div class="card-dark">
        <div class="ico"><?php echo insolab_icon('scan'); ?></div>
        <h4><?php esc_html_e('Pembacaan acuan', 'insolab'); ?></h4>
        <p><?php esc_html_e('Acuan anda diperiksa satu per satu — lengkung, taburan tekanan dan bentuk tumit.', 'insolab'); ?></p>
      </div>
      <div class="card-dark">
        <div class="ico"><?php echo insolab_icon('layers'); ?></div>
        <h4><?php esc_html_e('Pembentukan tangan', 'insolab'); ?></h4>
        <p><?php esc_html_e('Insole dibentuk mengikut acuan anda — bukan dipilih dari rak mengikut saiz.', 'insolab'); ?></p>
      </div>
      <div class="card-dark">
        <div class="ico"><?php echo insolab_icon('award'); ?></div>
        <h4><?php esc_html_e('Kawalan kualiti', 'insolab'); ?></h4>
        <p><?php esc_html_e('Diperiksa sebelum dibungkus — dan dilayan semula jika tidak kena.', 'insolab'); ?></p>
      </div>
    </div>
  </div>
</section>

<!-- ══════════ JAMINAN 180 HARI ══════════ -->
<section class="sec" id="jaminan">
  <div class="wrap" data-reveal>
    <div class="guarantee">
      <div class="g-badge">
        <?php echo insolab_icon('shield'); ?>
        <span>180</span>
        <small><?php esc_html_e('hari', 'insolab'); ?></small>
      </div>
      <div>
        <h2><?php esc_html_e('180 Hari Untuk Rasa Bezanya.', 'insolab'); ?></h2>
        <p><?php esc_html_e('Kami faham — insole bukan pembelian kecil. Sebab itu kami beri anda 180 hari penuh untuk cuba, tanpa tekanan. Kalau selepas itu kaki anda masih belum selesa, hubungi kami: kami laraskan tanpa kos, atau pulangkan wang anda. Tanpa soal rumit, tanpa borang panjang.', 'insolab'); ?></p>
        <ul class="g-list">
          <li><?php echo insolab_icon('check'); ?> <?php esc_html_e('Pos balik untuk pelarasan — kami tanggung', 'insolab'); ?></li>
          <li><?php echo insolab_icon('check'); ?> <?php esc_html_e('WhatsApp terus — kami balas sendiri', 'insolab'); ?></li>
          <li><?php echo insolab_icon('check'); ?> <?php esc_html_e('180 hari penuh, bukan 14 hari', 'insolab'); ?></li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ══════════ KENAPA INSOLAB (perbandingan gaya "Why Upstep") ══════════ -->
<section class="sec sec-gray" id="kenapa-pilih">
  <div class="wrap" data-reveal>
    <div class="sec-head">
      <p class="kicker"><?php esc_html_e('Kenapa InsoLab?', 'insolab'); ?></p>
      <h2><?php esc_html_e('Bezanya jelas bila anda bandingkan', 'insolab'); ?></h2>
    </div>
    <div class="cmp">
      <div class="cmp-row cmp-head">
        <div></div>
        <div class="cmp-us"><?php esc_html_e('InsoLab', 'insolab'); ?></div>
        <div><?php esc_html_e('Insole kedai biasa', 'insolab'); ?></div>
      </div>
      <?php
      $cmp = [
          [__('Dibuat dari acuan kaki anda', 'insolab'), true, false],
          [__('Sokongan lengkung ikut bentuk anda', 'insolab'), true, false],
          [__('Boleh dipotong ikut kasut', 'insolab'), true, true],
          [__('Jaminan 180 hari wang kembali', 'insolab'), true, false],
          [__('Dibuat di Malaysia, hantar terus', 'insolab'), true, false],
          [__('Siap 16–20 hari, dihantar ke rumah', 'insolab'), true, false],
      ];
      foreach ($cmp as $c) : ?>
        <div class="cmp-row">
          <div class="cmp-label"><?php echo esc_html($c[0]); ?></div>
          <div class="cmp-cell"><?php echo $c[1] ? '<span class="yes">✓</span>' : '<span class="no">—</span>'; ?></div>
          <div class="cmp-cell"><?php echo $c[2] ? '<span class="yes">✓</span>' : '<span class="no">—</span>'; ?></div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="text-center" style="margin-top:34px">
      <a class="btn btn-lg" href="<?php echo esc_url($wa); ?>" target="_blank" rel="noopener"><?php esc_html_e('Pesan Kit Acuan Sekarang', 'insolab'); ?> &rarr;</a>
    </div>
  </div>
</section>

<!-- ══════════ FAQ ══════════ -->
<section class="sec" id="faq" data-num="07">
  <div class="wrap" data-reveal>
    <div class="sec-head" data-num="07">
      <p class="kicker">FAQ</p>
      <h2><?php esc_html_e('Soalan biasa', 'insolab'); ?></h2>
    </div>
    <div class="faq">
      <?php
      $faqs = [
          ['Berapa lama proses keseluruhan?', 'Kit Acuan tiba dalam 2–3 hari bekerja. Selepas anda pos acuan kembali, insole anda dibuat dalam 16–20 hari bekerja di Makmal InsoLab — kira-kira tiga minggu keseluruhan.'],
          ['Boleh muat kasut saya?', 'Boleh. Insole ini boleh dipotong mengikut kebanyakan kasut, termasuk kasut sukan, kasut kerja dan kasut safety.'],
          ['Kalau tak rasa selesa?', 'Anda ada jaminan 180 hari. Hubungi kami dan kami akan bantu laraskan — kalau masih tidak puas, wang boleh dipulangkan.'],
          ['Hantar ke seluruh Malaysia?', 'Ya — penghantaran percuma ke seluruh Malaysia, termasuk Sabah dan Sarawak.'],
          ['Sesuai untuk masalah kaki tertentu?', 'Insole kami direka untuk keselesaan dan sokongan harian. Ia bukan peranti perubatan dan tidak menggantikan nasihat doktor atau ahli fisioterapi.'],
      ];
      foreach ($faqs as $i => $f) : ?>
        <div class="q<?php echo $i === 0 ? ' open' : ''; ?>">
          <button class="q-btn" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>" type="button"><?php echo esc_html($f[0]); ?></button>
          <div class="q-body"><p><?php echo esc_html($f[1]); ?></p></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ══════════ CTA ══════════ -->
<section class="sec" style="padding-top:0">
  <div class="wrap">
    <div class="cta-box" data-reveal>
      <h2><?php esc_html_e('Sedia nak rasa bezanya?', 'insolab'); ?></h2>
      <p><?php esc_html_e('Pesan Kit Acuan hari ini — buat acuan di rumah dalam 5 minit, dan Makmal InsoLab uruskan selebihnya.', 'insolab'); ?></p>
      <a class="btn btn-lg btn-wa" href="<?php echo esc_url($wa); ?>" target="_blank" rel="noopener"><?php echo insolab_icon('wa'); ?> <?php esc_html_e('WhatsApp Kami', 'insolab'); ?></a>
      <a class="btn btn-lg btn-ghost" style="background:rgba(255,255,255,.08);color:#fff!important;border-color:rgba(255,255,255,.28)" href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/')); ?>"><?php esc_html_e('Lihat Insole', 'insolab'); ?></a>
    </div>
  </div>
</section>

<?php get_footer();
