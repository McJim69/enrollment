/* ==========================================================================
   WEST PRIME ENROLLMENT SYSTEM - DARK / LIGHT THEME TOGGLE SCRIPT
   ========================================================================== */

(function() {
	// 1. Immediately apply saved theme to prevent flash of wrong theme
	var savedTheme = localStorage.getItem('enrollment_theme');
	if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
		document.documentElement.setAttribute('data-theme', 'dark');
	} else {
		document.documentElement.setAttribute('data-theme', 'light');
	}
})();

function toggleEnrollTheme() {
	var currentTheme = document.documentElement.getAttribute('data-theme');
	var newTheme = currentTheme === 'dark' ? 'light' : 'dark';
	
	document.documentElement.setAttribute('data-theme', newTheme);
	localStorage.setItem('enrollment_theme', newTheme);
	
	updateThemeToggleIcons(newTheme);
}

function updateThemeToggleIcons(theme) {
	var buttons = document.querySelectorAll('.btn-theme-toggle');
	buttons.forEach(function(btn) {
		if (theme === 'dark') {
			btn.innerHTML = '<i class="fas fa-sun"></i>';
			btn.setAttribute('title', 'Switch to Light Mode');
			btn.style.color = '#fbbf24';
		} else {
			btn.innerHTML = '<i class="fas fa-moon"></i>';
			btn.setAttribute('title', 'Switch to Dark Mode');
			btn.style.color = '#60a5fa';
		}
	});
}

document.addEventListener('DOMContentLoaded', function() {
	var currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
	updateThemeToggleIcons(currentTheme);
});
