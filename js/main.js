/**
 * Personal Portfolio Website - Atlas Style Vertical Sidebar & Theme Switcher
 */

document.addEventListener('DOMContentLoaded', () => {
  initThemeSwitcher();
  initTypewriter();
  initSidebarNav();
  initCursorSpotlight();
  initParticleCanvas();
  initScrollReveal();
  init3DTilt();
  initResumeDropdown();
  initContactForm();
});

/* -------------------------------------------------------------
 * 1. Theme Color Switcher & LocalStorage Persistence
 * ------------------------------------------------------------- */
function initThemeSwitcher() {
  const toggleBtn = document.getElementById('themeToggleBtn');
  const palette = document.getElementById('themePalette');
  const colorBtns = document.querySelectorAll('.theme-color-btn');

  if (toggleBtn && palette) {
    toggleBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      palette.classList.toggle('active');
    });

    document.addEventListener('click', (e) => {
      if (!palette.contains(e.target) && !toggleBtn.contains(e.target)) {
        palette.classList.remove('active');
      }
    });
  }

  // Load saved theme from localStorage
  const savedTheme = localStorage.getItem('portfolio_theme') || 'orange';
  setTheme(savedTheme);

  colorBtns.forEach((btn) => {
    btn.addEventListener('click', () => {
      const theme = btn.getAttribute('data-theme');
      setTheme(theme);
      if (palette) palette.classList.remove('active');
    });
  });
}

function setTheme(theme) {
  document.body.classList.remove('theme-orange', 'theme-red', 'theme-green', 'theme-blue', 'theme-pink');
  document.body.classList.add(`theme-${theme}`);
  localStorage.setItem('portfolio_theme', theme);

  document.querySelectorAll('.theme-color-btn').forEach((btn) => {
    btn.classList.toggle('active', btn.getAttribute('data-theme') === theme);
  });
}

/* -------------------------------------------------------------
 * 2. Typewriter Effect in Hero Section
 * ------------------------------------------------------------- */
function initTypewriter() {
  const typewriterElement = document.getElementById('typewriter');
  if (!typewriterElement) return;

  const phrases = [
    'Aspiring Web Developer',
    'IT Graduate'
  ];

  let phraseIndex = 0;
  let charIndex = 0;
  let isDeleting = false;
  let typeSpeed = 100;

  function type() {
    const currentPhrase = phrases[phraseIndex];

    if (isDeleting) {
      typewriterElement.textContent = currentPhrase.substring(0, charIndex - 1);
      charIndex--;
      typeSpeed = 50;
    } else {
      typewriterElement.textContent = currentPhrase.substring(0, charIndex + 1);
      charIndex++;
      typeSpeed = 100;
    }

    if (!isDeleting && charIndex === currentPhrase.length) {
      typeSpeed = 2000; // Pause at end of phrase
      isDeleting = true;
    } else if (isDeleting && charIndex === 0) {
      isDeleting = false;
      phraseIndex = (phraseIndex + 1) % phrases.length;
      typeSpeed = 500;
    }

    setTimeout(type, typeSpeed);
  }

  type();
}

/* -------------------------------------------------------------
 * 3. Sidebar Navigation & Active Link Tracking
 * ------------------------------------------------------------- */
function initSidebarNav() {
  const sidebarToggle = document.getElementById('sidebarToggle');
  const sidebar = document.getElementById('sidebar');
  const navLinks = document.querySelectorAll('.sidebar-links a[href^="#"]');
  const sections = document.querySelectorAll('section[id], main[id]');

  if (sidebarToggle && sidebar) {
    sidebarToggle.addEventListener('click', (e) => {
      e.stopPropagation();
      const isOpen = sidebar.classList.toggle('open');
      sidebarToggle.classList.toggle('is-active', isOpen);
      sidebarToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    navLinks.forEach((link) => {
      link.addEventListener('click', () => {
        sidebar.classList.remove('open');
        if (sidebarToggle) {
          sidebarToggle.classList.remove('is-active');
          sidebarToggle.setAttribute('aria-expanded', 'false');
        }
      });
    });

    document.addEventListener('click', (e) => {
      if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
        sidebar.classList.remove('open');
        sidebarToggle.classList.remove('is-active');
        sidebarToggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  // Active scroll tracking
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

    spotlight.style.background = `radial-gradient(600px circle at ${currentX}px ${currentY}px, var(--glow), transparent 70%)`;
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
      ctx.fillStyle = `rgba(255, 94, 0, ${Math.max(0.05, Math.min(0.6, this.opacity))})`;
      ctx.shadowBlur = 10;
      ctx.shadowColor = 'var(--accent)';
      ctx.fill();
      ctx.shadowBlur = 0;
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
 * 9. Contact Form Micro-Interactions & Asynchronous Submission
 * ------------------------------------------------------------- */
function initContactForm() {
  const form = document.getElementById('contactForm');
  if (!form) return;

  const submitBtn = form.querySelector('button[type="submit"]');

  // Check URL query string for fallback redirects (?mail=sent)
  const urlParams = new URLSearchParams(window.location.search);
  const mailStatus = urlParams.get('mail');
  if (mailStatus === 'sent' || mailStatus === 'success') {
    showToast('success', 'Email Sent Successfully!', 'Thank you for reaching out. I will get back to you soon!');
    window.history.replaceState({}, document.title, window.location.pathname + window.location.hash);
  } else if (mailStatus === 'failed' || mailStatus === 'error') {
    showToast('error', 'Message Failed', 'Could not send email message. Please try again.');
    window.history.replaceState({}, document.title, window.location.pathname + window.location.hash);
  }

  // Live input handlers & character limits
  const nameInput = document.getElementById('name');
  const emailInput = document.getElementById('email');
  const subjectInput = document.getElementById('subject');
  const messageInput = document.getElementById('message');

  const subjectCount = document.getElementById('subjectCount');
  const messageCount = document.getElementById('messageCount');

  // Prevent numbers in Name input in real-time
  if (nameInput) {
    nameInput.addEventListener('input', (e) => {
      e.target.value = e.target.value.replace(/[0-9]/g, '');
    });
  }

  // Live character counter for Subject (Max 100)
  if (subjectInput && subjectCount) {
    const updateSubjectCount = () => {
      const len = subjectInput.value.length;
      subjectCount.textContent = `${len} / 100`;
      subjectCount.classList.toggle('limit-near', len >= 90);
    };
    subjectInput.addEventListener('input', updateSubjectCount);
    updateSubjectCount();
  }

  // Live character counter for Message (Max 1000)
  if (messageInput && messageCount) {
    const updateMessageCount = () => {
      const len = messageInput.value.length;
      messageCount.textContent = `${len} / 1000`;
      messageCount.classList.toggle('limit-near', len >= 900);
    };
    messageInput.addEventListener('input', updateMessageCount);
    updateMessageCount();
  }

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    if (!submitBtn) return;

    const nameVal = (nameInput ? nameInput.value : '').trim();
    const emailVal = (emailInput ? emailInput.value : '').trim();
    const subjectVal = (subjectInput ? subjectInput.value : '').trim();
    const messageVal = (messageInput ? messageInput.value : '').trim();

    // 1. Name validation (no numbers allowed)
    if (/[0-9]/.test(nameVal)) {
      showToast('error', 'Invalid Name', 'Name must contain letters only (no numbers allowed).');
      if (nameInput) nameInput.focus();
      return;
    }

    // 2. Email validation (strict format check)
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(emailVal)) {
      showToast('error', 'Invalid Email', 'Please enter a valid email address (e.g., name@example.com).');
      if (emailInput) emailInput.focus();
      return;
    }

    // 3. Subject validation (limit 100)
    if (subjectVal.length > 100) {
      showToast('error', 'Subject Limit Exceeded', 'Subject must not exceed 100 characters.');
      if (subjectInput) subjectInput.focus();
      return;
    }

    // 4. Message validation (limit 1000)
    if (messageVal.length > 1000) {
      showToast('error', 'Message Limit Exceeded', 'Message text must not exceed 1000 characters.');
      if (messageInput) messageInput.focus();
      return;
    }

    const originalBtnText = submitBtn.innerText;
    submitBtn.classList.add('loading');
    submitBtn.disabled = true;
    submitBtn.innerText = 'Sending message...';

    const formData = new FormData(form);

    try {
      const response = await fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        }
      });

      let result = {};
      try {
        result = await response.json();
      } catch (err) {
        result = { success: response.ok };
      }

      if (response.ok && (result.success !== false)) {
        form.reset();
        if (subjectCount) subjectCount.textContent = '0 / 100';
        if (messageCount) messageCount.textContent = '0 / 1000';
        showToast('success', 'Email Sent Successfully!', 'Thank you for reaching out! I will respond to your message as soon as possible.');
      } else {
        const errorMsg = result.reason || result.message || 'There was an issue sending your message. Please try again.';
        showToast('error', 'Message Failed', errorMsg);
      }
    } catch (error) {
      console.error('Contact Form Submit Error:', error);
      showToast('error', 'Submission Error', 'Unable to connect. Please check your internet connection and try again.');
    } finally {
      // Immediately reset button state so it NEVER stays stuck loading!
      submitBtn.classList.remove('loading');
      submitBtn.disabled = false;
      submitBtn.innerText = originalBtnText;
    }
  });
}

/* -------------------------------------------------------------
 * 10. Top-Right Floating Toast Notification System
 * ------------------------------------------------------------- */
function showToast(type, title, message) {
  let container = document.querySelector('.toast-container');
  if (!container) {
    container = document.createElement('div');
    container.className = 'toast-container';
    document.body.appendChild(container);
  }

  const toast = document.createElement('div');
  toast.className = `toast-notification toast-${type}`;

  const isSuccess = type === 'success';
  const iconSvg = isSuccess
    ? `<svg class="toast-icon success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>`
    : `<svg class="toast-icon error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>`;

  toast.innerHTML = `
    ${iconSvg}
    <div class="toast-body">
      <div class="toast-title">${title}</div>
      <div class="toast-message">${message}</div>
    </div>
    <button class="toast-close" type="button" aria-label="Close alert">&times;</button>
  `;

  container.appendChild(toast);

  // Trigger slide-in animation
  requestAnimationFrame(() => {
    toast.classList.add('show');
  });

  const closeBtn = toast.querySelector('.toast-close');
  const dismiss = () => {
    toast.classList.remove('show');
    setTimeout(() => {
      if (toast.parentNode) {
        toast.parentNode.removeChild(toast);
      }
    }, 400);
  };

  if (closeBtn) {
    closeBtn.addEventListener('click', dismiss);
  }

  // Auto-dismiss after 5 seconds
  setTimeout(dismiss, 5000);
}
