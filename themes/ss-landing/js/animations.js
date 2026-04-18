/**
 * SS Landing 애니메이션
 * GSAP + ScrollTrigger 기반 스크롤 연동 애니메이션
 */

document.addEventListener('DOMContentLoaded', function () {
  // GSAP 없으면 조용히 종료
  if (typeof gsap === 'undefined') return;

  gsap.registerPlugin(ScrollTrigger);

  /* ============================================================
     히어로 — 페이지 진입 시 순차 등장
  ============================================================ */
  const heroTl = gsap.timeline({ defaults: { ease: 'power3.out' } });

  heroTl
    .from('.hero__eyebrow',   { opacity: 0, y: 16, duration: 0.5 })
    .from('.hero__title',     { opacity: 0, y: 24, duration: 0.6 }, '-=0.2')
    .from('.hero__subtitle',  { opacity: 0, y: 16, duration: 0.5 }, '-=0.3')
    .from('.hero__actions',   { opacity: 0, y: 12, duration: 0.5 }, '-=0.3')
    .from('.hero__note',      { opacity: 0,         duration: 0.4 }, '-=0.2');

  /* ============================================================
     통계 숫자 카운트업
  ============================================================ */
  const statNumbers = document.querySelectorAll('.stat-item__number');

  statNumbers.forEach(function (el) {
    const raw    = el.textContent.trim();
    const suffix = raw.replace(/[0-9]/g, '');  // %, 원, 개 등
    const target = parseInt(raw.replace(/[^0-9]/g, ''), 10);

    if (isNaN(target)) return;

    ScrollTrigger.create({
      trigger: el,
      start: 'top 85%',
      once: true,
      onEnter: function () {
        gsap.to({ val: 0 }, {
          val: target,
          duration: 1.4,
          ease: 'power2.out',
          onUpdate: function () {
            el.textContent = Math.round(this.targets()[0].val) + suffix;
          },
        });
      },
    });
  });

  /* ============================================================
     섹션 공통 — 스크롤 진입 시 페이드+슬라이드 업
  ============================================================ */
  const fadeTargets = [
    '.why-card',
    '.curriculum-step',
    '.outcome-item',
    '.section__title',
    '.section__lead',
  ];

  fadeTargets.forEach(function (selector) {
    gsap.utils.toArray(selector).forEach(function (el, i) {
      gsap.from(el, {
        scrollTrigger: {
          trigger: el,
          start: 'top 88%',
          toggleActions: 'play none none none',
        },
        opacity: 0,
        y: 28,
        duration: 0.55,
        delay: i * 0.07,
        ease: 'power2.out',
        clearProps: 'all',
      });
    });
  });

  /* ============================================================
     CTA 섹션 — 배경 파티클 느낌의 스케일 효과
  ============================================================ */
  gsap.from('.apply__form-wrap', {
    scrollTrigger: {
      trigger: '.apply',
      start: 'top 75%',
    },
    opacity: 0,
    scale: 0.96,
    y: 24,
    duration: 0.6,
    ease: 'back.out(1.4)',
  });

  /* ============================================================
     헤더 — 스크롤 시 그림자 추가
  ============================================================ */
  ScrollTrigger.create({
    start: 'top -60',
    onUpdate: function (self) {
      const header = document.querySelector('.site-header');
      if (!header) return;
      if (self.progress > 0) {
        header.style.boxShadow = '0 2px 12px rgba(0,0,0,0.08)';
      } else {
        header.style.boxShadow = 'none';
      }
    },
  });
});
