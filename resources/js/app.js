import './bootstrap';

document.body.classList.add('loading');
window.addEventListener('load', () => {
    const preloader = document.getElementById('preloader');
    preloader.classList.add('hidden');
    document.body.classList.remove('loading');
    setTimeout(() => preloader.remove(), 500);
});
document.addEventListener('DOMContentLoaded', () => {
    const burger = document.getElementById('burger');
    const menu = document.getElementById('navMenu');

    burger.addEventListener('click', () => {
        const isActive = menu.classList.toggle('active');
        burger.classList.toggle('active');
        burger.setAttribute('aria-expanded', isActive);
        document.body.style.overflow = isActive ? 'hidden' : '';
    });

    // Закрытие при клике на ссылку
    menu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', () => {
            menu.classList.remove('active');
            burger.classList.remove('active');
            burger.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        });
    });
});
document.addEventListener('DOMContentLoaded', () => {
    const toggles = document.querySelectorAll('[data-order-toggle]');

    toggles.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.orderToggle;
            const details = document.querySelector(`[data-order-details="${id}"]`);
            const textEl = button.querySelector('.order-card__toggle-text');

            const isOpen = button.classList.toggle('active');

            if (isOpen) {
                details.style.maxHeight = details.scrollHeight + 'px';
                textEl.textContent = 'Скрыть';
            } else {
                details.style.maxHeight = null;
                textEl.textContent = 'Детали';
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-toggle-password]').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.togglePassword;
            const input = document.getElementById(id);
            const icon = btn.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    });
});
