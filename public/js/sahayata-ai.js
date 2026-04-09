(function () {
    const forms = document.querySelectorAll('[data-ai-form]');
    const searchForms = document.querySelectorAll('[data-ai-search]');

    function formatSentence(value) {
        const trimmed = value.trim();
        if (!trimmed) return value;
        const withPeriod = /[.!?]$/.test(trimmed) ? trimmed : `${trimmed}.`;
        return withPeriod.charAt(0).toUpperCase() + withPeriod.slice(1);
    }

    forms.forEach((form) => {
        form.addEventListener('input', () => {
            const required = form.querySelectorAll('[required]');
            let complete = 0;
            required.forEach((field) => {
                if (field.value.trim()) complete += 1;
            });
            const pct = required.length ? Math.round((complete / required.length) * 100) : 100;
            const msg = form.querySelector('#form-quality-msg, #member-form-hint');
            if (msg) {
                msg.textContent = `AI form quality score: ${pct}% complete.`;
            }
        });

        const bioInput = form.querySelector('#bio-input');
        const bioHint = form.querySelector('#bio-hint');
        if (bioInput) {
            bioInput.addEventListener('blur', () => {
                bioInput.value = formatSentence(bioInput.value);
                if (bioHint) {
                    bioHint.textContent = 'AI polished bio tone and punctuation.';
                    bioHint.classList.remove('text-muted');
                    bioHint.classList.add('text-success');
                }
            });
        }

        const photoInput = form.querySelector('#photo-input');
        if (photoInput) {
            photoInput.addEventListener('change', () => {
                const file = photoInput.files && photoInput.files[0];
                if (file && file.size > 2 * 1024 * 1024) {
                    alert('AI warning: Please upload a clearer compressed image under 2MB.');
                }
            });
        }

        const designation = form.querySelector('#designation');
        const designationHint = form.querySelector('#designation-hint');
        if (designation && designationHint) {
            designation.addEventListener('change', () => {
                const msg = designation.value === 'Volunteer'
                    ? 'AI tip: add service area and availability for volunteers.'
                    : 'AI tip: add impact-focused role summary.';
                designationHint.textContent = msg;
            });
        }
    });

    searchForms.forEach((form) => {
        const input = form.querySelector('input[name="q"]');
        if (!input) return;
        input.addEventListener('input', () => {
            const hintId = form.dataset.aiSearch === 'members' ? '#member-search-hint' : '#team-search-hint';
            const hint = form.querySelector(hintId) || document.querySelector(hintId);
            if (hint && input.value.length > 2) {
                hint.textContent = `AI suggests searching "${input.value}" with district/role filter.`;
            }
        });
    });
})();
