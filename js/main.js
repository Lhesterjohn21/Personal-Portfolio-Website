/**
 * Personal Portfolio Website - Atlas-Inspired Design System & Interactions
 */

document.addEventListener('DOMContentLoaded', () => {
  initThemeSwitcher();
  initTypewriter();
  initMobileSidebar();
  initCursorSpotlight();
  initParticleCanvas();
  initScrollReveal();
  init3DTilt();
  initResumeDropdown();
  initContactForm();
  initActiveNav();
});

/* -------------------------------------------------------------
 * 1. Interactive Theme Color Switcher Widget
 * ------------------------------------------------------------- */
function initThemeSwitcher() {
  const toggleBtn = document.getElementById('themeToggleBtn');
  const panel = document.getElementById('themePanel');
  const colorBtns = document.querySelectorAll('.theme-color-btn');

  if (!toggleBtn || !panel) return;

  // Toggle Theme Panel
  toggleBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    panel.classList.toggle('is-active');
  });

  document.addEventListener('click', (e) => {
    if (!panel.contains(e.target) && !toggleBtn.contains(e.target)) {
      panel.classList.remove('is-active');
    }
  });

  // Theme Colors Mapping
  const themes = {
    orange: { primary: '#ff6b00', glow: 'rgba(255, 107, 0, 0.35)', soft: 'rgba(255, 107, 0, 0.15)' },
    red: { primary: '#ff3b30', glow: 'rgba(255, 59, 48, 0.35)', soft: 'rgba(255, 59, 48, 0.15)' },
    green: { primary: '#22c55e', glow: 'rgba(34, 197, 94, 0.35)', soft: 'rgba(34, 197, 94, 0.15)' },
    blue: { primary: '#2563eb', glow: 'rgba(37, 99, 235, 0.35)', soft: 'rgba(37, 99, 235, 0.15)' },
    pink: { primary: '#ec4899', glow: 'rgba(236, 72, 153, 0.35)', soft: 'rgba(236, 72, 153, 0.15)' },
  };

  function applyTheme(colorKey) {
    const theme = themes[colorKey] || themes.orange;
    document.documentElement.style.setProperty('--primary', theme.primary);
    document.documentElement.style.setProperty('--primary-glow', theme.glow);
    document.documentElement.style.setProperty('--primary-soft', theme.soft);

    colorBtns.forEach((btn) => {
      btn.classList.toggle('active', btn.getAttribute('data-color') === colorKey);
    });

    localStorage.setItem('portfolio_theme_color', colorKey);
  }

  colorBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
      const color = btn.getAttribute('data-color');
      applyTheme(color);
    });
  });

  // Load saved theme or default to orange
  const savedColor = localStorage.getItem('portfolio_theme_color') || 'orange';
  applyTheme(savedColor);
}

/* -------------------------------------------------------------
 * 2. Typewriter Effect
 * ------------------------------------------------------------- */
function initTypewriter() {
  const typewriterEl = document.getElementById('typewriterText');
  if (!typewriterEl) return;

  const words = ['Web Developer', 'IT Graduate', 'Full-Stack Developer', 'Tech Enthusiast'];
  let wordIndex = 0;
  let charIndex = 0;
  let isDeleting = false;
  let typeSpeed = 100;

  function type() {
    const currentWord = words[wordIndex];

    if (isDeleting) {
      typewriterEl.textContent = currentWord.substring(0, charIndex - 1);
      charIndex--;
      typeSpeed = 50;
    } else {
      typewriterEl.textContent = currentWord.substring(0, charIndex + 1);
      charIndex++;
      typeSpeed = 120;
    }

    if (!isDeleting && charIndex === currentWord.length) {
      isDeleting = true;
      typeSpeed = 2000; // Pause at end of word
    } else if (isDeleting && charIndex === 0) {
      isDeleting = false;
      wordIndex = (wordIndex + 1) % words.length;
      typeSpeed = 500;
    }

    setTimeout(type, typeSpeed);
  }

  type();
}

/* -------------------------------------------------------------
 * 3. Mobile Sidebar Navigation Drawer
 * ------------------------------------------------------------- */
function initMobileSidebar() {
  const sidebarToggle = document.getElementById('sidebarToggle');
  const sidebar = document.getElementById('sidebar');
  const navLinks = document.querySelectorAll('.sidebar-nav a');

  if (!sidebarToggle || !sidebar) return;

  sidebarToggle.addEventListener('click', (e) => {
    e.stopPropagation();
    sidebar.classList.toggle('is-open');
    sidebarToggle.classList.toggle('is-active');
  });

  navLinks.forEach((link) => {
    link.addEventListener('click', () => {
      sidebar.classList.remove('is-open');
      if (sidebarToggle) sidebarToggle.classList.remove('is-active');
    });
  });

  document.addEventListener('click', (e) => {
    if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
      sidebar.classList.remove('is-open');
      if (sidebarToggle) sidebarToggle.classList.remove('is-active');
    }
  });
}

/* -------------------------------------------------------------
 * 4. Interactive Cursor Spotlight
 * ------------------------------------------------------------- */
function initCursorSpotlight() {
  const spotlight = document.getElementById('cursor-spotlight');
  if (!spotlight) return;

  let mouseX = window.innerWidth / 2;
  let mouseY = window.innerHeight / 2;
  let currentX = mouseX;
  let currentY = mouseY;

  window.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
  });

  function animateSpotlight() {
    currentX += (mouseX - currentX) * 0.15;
    currentY += (mouseY - currentY) * 0.15;

    const primaryColor = getComputedStyle(document.documentElement).getPropertyValue('--primary').trim() || '#ff6b00';
    spotlight.style.background = `radial-gradient(600px circle at ${currentX}px ${currentY}px, ${primaryColor}18, transparent 70%)`;
    requestAnimationFrame(animateSpotlight);
  }
  animateSpotlight();
}

/* -------------------------------------------------------------
 * 5. Ambient Particle Canvas Background
 * ------------------------------------------------------------- */
function initParticleCanvas() {
  const canvas = document.getElementById('bg-canvas');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');
  let width = (canvas.width = window.innerWidth);
  let height = (canvas.height = window.innerHeight);

  window.addEventListener('resize', () => {
    width = canvas.width = window.innerWidth;
    height = canvas.height = window.innerHeight;
  });

  const particles = [];
  const particleCount = Math.min(Math.floor(window.innerWidth / 25), 45);

  class Particle {
    constructor() {
      this.reset();
    }

    reset() {
      this.x = Math.random() * width;
      this.y = Math.random() * height;
      this.size = Math.random() * 2 + 0.5;
      this.speedX = (Math.random() - 0.5) * 0.3;
      this.speedY = (Math.random() - 0.5) * 0.3;
      this.opacity = Math.random() * 0.4 + 0.1;
      this.pulseSpeed = Math.random() * 0.02 + 0.005;
    }

    update() {
      this.x += this.speedX;
      this.y += this.speedY;

      this.opacity += Math.sin(Date.now() * this.pulseSpeed) * 0.003;

      if (this.x < 0 || this.x > width || this.y < 0 || this.y > height) {
        this.reset();
      }
    }

    draw() {
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(255, 255, 255, ${Math.max(0.05, Math.min(0.5, this.opacity))})`;
      ctx.fill();
    }
  }

  for (let i = 0; i < particleCount; i++) {
    particles.push(new Particle());
  }

  function render() {
    ctx.clearRect(0, 0, width, height);
    particles.forEach((p) => {
      p.update();
      p.draw();
    });
    requestAnimationFrame(render);
  }
  render();
}

/* -------------------------------------------------------------
 * 6. Scroll Reveal Observer
 * ------------------------------------------------------------- */
function initScrollReveal() {
  const revealElements = document.querySelectorAll('[data-reveal]');
  if (!revealElements.length) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const delay = entry.target.getAttribute('data-delay') || 0;
          setTimeout(() => {
            entry.target.classList.add('revealed');
          }, parseInt(delay, 10));
          observer.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.12,
      rootMargin: '0px 0px -40px 0px',
    }
  );

  revealElements.forEach((el) => observer.observe(el));
}

/* -------------------------------------------------------------
 * 7. Interactive 3D Card Tilt Effect
 * ------------------------------------------------------------- */
function init3DTilt() {
  if ('ontouchstart' in window || navigator.maxTouchPoints > 0) return;

  const tiltCards = document.querySelectorAll('[data-tilt]');
  if (!tiltCards.length) return;

  tiltCards.forEach((card) => {
    card.addEventListener('mousemove', (e) => {
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;

      const centerX = rect.width / 2;
      const centerY = rect.height / 2;

      const rotateX = (centerY - y) / 18;
      const rotateY = (x - centerX) / 18;

      card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(8px)`;
      card.style.setProperty('--mouse-x', `${(x / rect.width) * 100}%`);
      card.style.setProperty('--mouse-y', `${(y / rect.height) * 100}%`);
    });

    card.addEventListener('mouseleave', () => {
      card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateZ(0px)';
    });
  });
}

/* -------------------------------------------------------------
 * 8. Resume Dropdown Interactions
 * ------------------------------------------------------------- */
function initResumeDropdown() {
  const dropdowns = document.querySelectorAll('.resume-dropdown');

  dropdowns.forEach((dropdown) => {
    const toggleBtn = dropdown.querySelector('.resume-btn');
    if (!toggleBtn) return;

    toggleBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      e.preventDefault();
      const isOpen = dropdown.classList.contains('open') || dropdown.classList.contains('is-open');
      if (isOpen) {
        dropdown.classList.remove('open', 'is-open');
        toggleBtn.setAttribute('aria-expanded', 'false');
      } else {
        dropdown.classList.add('open', 'is-open');
        toggleBtn.setAttribute('aria-expanded', 'true');
      }
    });
  });

  document.addEventListener('click', (e) => {
    dropdowns.forEach((dropdown) => {
      if (!dropdown.contains(e.target)) {
        dropdown.classList.remove('open', 'is-open');
        const toggleBtn = dropdown.querySelector('.resume-btn');
        if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'false');
      }
    });
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      dropdowns.forEach((dropdown) => {
        dropdown.classList.remove('open', 'is-open');
        const toggleBtn = dropdown.querySelector('.resume-btn');
        if (toggleBtn) toggleBtn.setAttribute('aria-expanded', 'false');
      });
    }
  });
}

/* -------------------------------------------------------------
 * 9. Contact Form Micro-Interactions
 * ------------------------------------------------------------- */
function initContactForm() {
  const form = document.getElementById('contactForm');
  if (!form) return;

  const submitBtn = form.querySelector('button[type="submit"]');

  form.addEventListener('submit', (e) => {
    if (!submitBtn) return;
    submitBtn.classList.add('loading');
    submitBtn.disabled = true;
    submitBtn.innerText = 'Sending message...';
  });
}

/* -------------------------------------------------------------
 * 10. Active Navigation Indicator
 * ------------------------------------------------------------- */
function initActiveNav() {
  const sections = document.querySelectorAll('section[id], main[id]');
  const navLinks = document.querySelectorAll('.sidebar-nav a[href^="#"]');

  if (!sections.length || !navLinks.length) return;

  window.addEventListener('scroll', () => {
    let current = '';
    const scrollPos = window.pageYOffset + 200;

    sections.forEach((section) => {
      const top = section.offsetTop;
      const height = section.offsetHeight;
      if (scrollPos >= top && scrollPos < top + height) {
        current = section.getAttribute('id');
      }
    });

    navLinks.forEach((link) => {
      link.classList.remove('active');
      if (link.getAttribute('href') === `#${current}`) {
        link.classList.add('active');
      }
    });
  });
}
