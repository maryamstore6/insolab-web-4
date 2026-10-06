/* ══════════════════════════════════════════════
   InsoLab — skrip ringan (tiada library berat)
   reveal · video · parallax · FAQ · nav · header
   ══════════════════════════════════════════════ */
(function () {
  'use strict';

  var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* Aktifkan animasi HANYA jika JS berjalan (progressive enhancement) */
  if (!reduce) document.documentElement.classList.add('js-reveal');

  /* 1 ── Reveal-on-scroll */
  var els = document.querySelectorAll('[data-reveal]');
  if (els.length) {
    if ('IntersectionObserver' in window && !reduce) {
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (e) {
          if (e.isIntersecting) {
            var d = parseInt(e.target.getAttribute('data-delay') || '0', 10);
            setTimeout(function () { e.target.classList.add('is-in'); }, d);
            io.unobserve(e.target);
          }
        });
      }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
      els.forEach(function (el) { io.observe(el); });
    } else {
      els.forEach(function (el) { el.classList.add('is-in'); });
    }
  }

  /* 2 ── Video: main bila masuk skrin */
  var vids = document.querySelectorAll('.vid');
  if (vids.length && 'IntersectionObserver' in window) {
    var vio = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        var v = e.target.querySelector('video');
        if (!v) return;
        if (e.isIntersecting) {
          v.muted = true;
          var p = v.play();
          if (p && p.catch) p.catch(function () {});
        } else if (!v.paused) {
          v.pause();
        }
      });
    }, { threshold: 0.35 });
    vids.forEach(function (w) { vio.observe(w); });
  }

  /* 3 ── Parallax halus pada imej hero (desktop sahaja) */
  var heroImg = document.querySelector('.hero-img img');
  if (heroImg && !reduce && window.matchMedia('(min-width: 1000px)').matches) {
    var tick = false;
    window.addEventListener('scroll', function () {
      if (tick) return;
      tick = true;
      requestAnimationFrame(function () {
        var y = Math.min(window.scrollY, 620);
        heroImg.style.transform = 'translateY(' + (y * -0.045) + 'px)';
        tick = false;
      });
    }, { passive: true });
  }

  /* 4 ── FAQ accordion */
  document.querySelectorAll('.q').forEach(function (q) {
    var btn = q.querySelector('.q-btn');
    var body = q.querySelector('.q-body');
    if (!btn || !body) return;
    if (q.classList.contains('open')) body.style.maxHeight = body.scrollHeight + 'px';
    btn.addEventListener('click', function () {
      var open = q.classList.contains('open');
      // tutup yang lain
      document.querySelectorAll('.q.open').forEach(function (o) {
        if (o !== q) {
          o.classList.remove('open');
          var ob = o.querySelector('.q-body');
          if (ob) ob.style.maxHeight = '0px';
          var ob2 = o.querySelector('.q-btn');
          if (ob2) ob2.setAttribute('aria-expanded', 'false');
        }
      });
      if (open) {
        q.classList.remove('open');
        body.style.maxHeight = '0px';
        btn.setAttribute('aria-expanded', 'false');
      } else {
        q.classList.add('open');
        body.style.maxHeight = body.scrollHeight + 'px';
        btn.setAttribute('aria-expanded', 'true');
      }
    });
  });
  window.addEventListener('resize', function () {
    document.querySelectorAll('.q.open .q-body').forEach(function (b) { b.style.maxHeight = b.scrollHeight + 'px'; });
  });

  /* 5 ── Header: shadow bila scroll */
  var hdr = document.getElementById('site-header');
  if (hdr) {
    var onScroll = function () {
      if (window.scrollY > 12) hdr.classList.add('scrolled');
      else hdr.classList.remove('scrolled');
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* 6 ── Nav mobile */
  var burger = document.getElementById('burger');
  var nav = document.getElementById('nav');
  var actions = document.getElementById('hdr-actions');
  if (burger && nav) {
    var toggle = function (force) {
      var open = typeof force === 'boolean' ? force : !nav.classList.contains('open');
      nav.classList.toggle('open', open);
      burger.classList.toggle('open', open);
      if (actions) actions.classList.toggle('open', open);
      document.body.classList.toggle('nav-open', open);
      burger.setAttribute('aria-expanded', open ? 'true' : 'false');
    };
    burger.addEventListener('click', function () { toggle(); });
    nav.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () { toggle(false); });
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') toggle(false);
    });
    document.addEventListener('click', function (e) {
      if (!nav.classList.contains('open')) return;
      if (nav.contains(e.target) || burger.contains(e.target) || (actions && actions.contains(e.target))) return;
      toggle(false);
    });
  }

  /* 7 ── Micro-interaction: kad (desktop) */
  if (!reduce && window.matchMedia('(hover: hover)').matches) {
    document.querySelectorAll('.card, .tcard').forEach(function (card) {
      card.addEventListener('pointermove', function (ev) {
        var r = card.getBoundingClientRect();
        var mx = (ev.clientX - r.left) / r.width - 0.5;
        var my = (ev.clientY - r.top) / r.height - 0.5;
        card.style.transform = 'translateY(-6px) rotateX(' + (my * -2.4) + 'deg) rotateY(' + (mx * 2.4) + 'deg)';
      });
      card.addEventListener('pointerleave', function () { card.style.transform = ''; });
    });
  }



  /* 10 ── Hero video: main bila masuk skrin + gerak ikut scroll (video ligado al scroll) */
  var heroVid = document.getElementById('heroVideo');
  var heroPhone = document.getElementById('heroPhone');
  var heroVisual = document.querySelector('.hero-visual');

  if (heroVid) {
    heroVid.muted = true;
    var playHero = function () { var p = heroVid.play(); if (p && p.catch) p.catch(function () {}); };
    if ('IntersectionObserver' in window) {
      var hio = new IntersectionObserver(function (e) {
        e.forEach(function (x) { x.isIntersecting ? playHero() : heroVid.pause(); });
      }, { threshold: 0.25 });
      hio.observe(heroVid);
    } else { playHero(); }

    /* Hormat pilihan pengguna: kalau tab tak aktif, jangan buang CPU */
    document.addEventListener('visibilitychange', function () {
      if (document.hidden) { heroVid.pause(); } else { playHero(); }
    });
  }

  /* Parallax + skala ikut scroll (desktop) */
  if (heroPhone && !reduce && window.matchMedia('(min-width: 1000px)').matches) {
    var ticking = false;
    window.addEventListener('scroll', function () {
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(function () {
        var y = Math.min(window.scrollY, 700);
        var t = y / 700;
        heroPhone.style.transform = 'rotate(' + (1.4 - t * 3.2) + 'deg) translateY(' + (y * -0.035) + 'px) scale(' + (1 - t * 0.035) + ')';
        if (heroVisual) {
          var f = document.querySelector('.hero-float-1');
          var g = document.querySelector('.hero-float-2');
          if (f) f.style.transform = 'translateY(' + (y * -0.075) + 'px)';
          if (g) g.style.transform = 'translateY(' + (y * 0.055) + 'px)';
        }
        ticking = false;
      });
    }, { passive: true });
  }


  /* 11 ── Butang WhatsApp terapung (animasi CSS; JS hanya untuk tutup) */
  var waFloat = document.getElementById('waFloat');
  if (waFloat) {
    waFloat.classList.add('anim');
    try {
      var raw = sessionStorage.getItem('wafloat_dismissed');
      if (raw) {
        var ts = parseInt(raw, 10) || 0;
        /* Muncul semula selepas 30 minit */
        if (Date.now() - ts < 1800000) waFloat.classList.add('hidden');
        else sessionStorage.removeItem('wafloat_dismissed');
      }
    } catch (e) {}
    var waClose = document.getElementById('waClose');
    if (waClose) {
      waClose.addEventListener('click', function () {
        waFloat.classList.add('hidden');
        try { sessionStorage.setItem('wafloat_dismissed', String(Date.now())); } catch (e) {}
      });
    }
  }


  /* 12 ── Skrol ke bahagian bila ada #hash (menu: #proses, #faq, #video...) */
  if (location.hash && location.hash.length > 1) {
    var target = null;
    try { target = document.querySelector(location.hash); } catch (e) {}
    if (target) {
      setTimeout(function () {
        var y = target.getBoundingClientRect().top + window.pageYOffset - 84;
        window.scrollTo({ top: y, behavior: 'auto' });
      }, 250);
    }
  }


  /* 13 ── Bintang interaktif (borang ulasan) */
  var picker = document.getElementById('starPicker');
  if (picker) {
    var hidden = document.getElementById('ratingValue');
    var stars = picker.querySelectorAll('.sp');
    var setVal = function (v) {
      stars.forEach(function (s) { s.classList.toggle('on', parseInt(s.getAttribute('data-v'), 10) <= v); });
      if (hidden) hidden.value = v;
    };
    setVal(parseInt(hidden && hidden.value ? hidden.value : '5', 10));
    stars.forEach(function (s) {
      s.addEventListener('click', function () { setVal(parseInt(s.getAttribute('data-v'), 10)); });
      s.addEventListener('mouseenter', function () {
        var v = parseInt(s.getAttribute('data-v'), 10);
        stars.forEach(function (x) { x.classList.toggle('on', parseInt(x.getAttribute('data-v'), 10) <= v); });
      });
    });
    picker.addEventListener('mouseleave', function () { setVal(parseInt(hidden.value, 10)); });
  }

  /* 14 ── Chip tapis ulasan (paparan) */
  document.querySelectorAll('.rev-chip').forEach(function (chip) {
    chip.addEventListener('click', function () {
      document.querySelectorAll('.rev-chip').forEach(function (c) { c.classList.remove('on'); });
      chip.classList.add('on');
    });
  });


  /* 15 ── Borang ulasan: label email Melayu + buang tanda wajib */
  var emLabel = document.querySelector('.rev-form-wrap .comment-form-email label');
  if (emLabel) {
    emLabel.innerHTML = emLabel.innerHTML.replace(/\s*<span class="required">.*?<\/span>/, '');
    emLabel.textContent = emLabel.textContent.replace(/Email.*/, 'Email (tidak dipaparkan, pilihan)');
  }
  var ck = document.querySelector('.rev-form-wrap .comment-form-cookies-consent label');
  if (ck) {
    ck.textContent = 'Simpan nama & email saya untuk ulasan seterusnya.';
  }
  var vcard = document.querySelector('.comment-form .comment-form-url');
  if (vcard) vcard.remove();


  /* ══════ SINEMATIK ══════ */
  if (!reduce) {

    /* 16 ── Progress bar skrol */
    var bar = document.getElementById('cineBar');
    if (bar) {
      var setBar = function () {
        var h = document.documentElement.scrollHeight - window.innerHeight;
        var p = h > 0 ? (window.pageYOffset / h) * 100 : 0;
        bar.style.width = Math.min(100, Math.max(0, p)) + '%';
      };
      window.addEventListener('scroll', setBar, { passive: true });
      window.addEventListener('resize', setBar);
      setBar();
    }

    /* 17 ── Reveal perkataan demi perkataan (H2 seksyen) */
    var heads = document.querySelectorAll('.sec-head h2');
    heads.forEach(function (h) {
      if (h.dataset.split) return;
      /* Jangan pecahkan jika ada elemen dalaman (contoh <em>, <br>) — elak rosak design */
      if (h.children.length > 0) return;
      h.dataset.split = '1';
      var words = h.trim ? [] : h.textContent.trim().split(/\s+/);
      h.innerHTML = words.map(function (w, i) {
        return '<span class="w"><span class="wi" style="transition-delay:' + (i * 55) + 'ms">' + w + '</span></span>';
      }).join(' ');
    });
    var wObs = new IntersectionObserver(function (es) {
      es.forEach(function (e) {
        if (e.isIntersecting) { e.target.classList.add('split-in'); wObs.unobserve(e.target); }
      });
    }, { threshold: 0.25 });
    heads.forEach(function (h) { wObs.observe(h); });

    /* 18 ── Parallax berlapis */
    var layers = document.querySelectorAll('[data-speed]');
    if (layers.length) {
      var lp = false;
      window.addEventListener('scroll', function () {
        if (lp) return;
        lp = true;
        requestAnimationFrame(function () {
          layers.forEach(function (el) {
            var r = el.getBoundingClientRect();
            if (r.bottom < -200 || r.top > window.innerHeight + 200) return;
            var mid = r.top + r.height / 2 - window.innerHeight / 2;
            var sp = parseFloat(el.getAttribute('data-speed')) || 0.05;
            el.style.transform = 'translate3d(0,' + (-mid * sp).toFixed(2) + 'px,0)';
          });
          lp = false;
        });
      }, { passive: true });
    }

    /* 19 ── Spotlight ikut kursor (desktop, seksyen gelap) */
    if (window.matchMedia('(hover: hover) and (min-width: 1000px)').matches) {
      document.querySelectorAll('.sec-dark, .hero-video, .cta-box').forEach(function (sec) {
        sec.addEventListener('pointermove', function (e) {
          var r = sec.getBoundingClientRect();
          sec.style.setProperty('--mx', ((e.clientX - r.left) / r.width * 100) + '%');
          sec.style.setProperty('--my', ((e.clientY - r.top) / r.height * 100) + '%');
        });
      });
    }

    /* 20 ── Ken Burns pada imej hero & kad */
    document.querySelectorAll('.hero-phone video, .woocommerce-product-gallery__image img').forEach(function (m) {
      m.classList.add('kenburns');
    });
  }


  /* 21 ── GUARD: pastikan teks H2 sentiasa muncul (SEO + keselamatan) */
  setTimeout(function () {
    document.querySelectorAll('.sec-head h2').forEach(function (h) {
      if (h.dataset.split && !h.classList.contains('split-in')) h.classList.add('split-in');
    });
  }, 2400);

  /* 9 ── GUARD: pastikan kandungan sentiasa muncul (SEO + keselamatan) */
  setTimeout(function () {
    document.querySelectorAll('[data-reveal]:not(.is-in)').forEach(function (el) {
      el.classList.add('is-in');
    });
  }, 2200);
})();
