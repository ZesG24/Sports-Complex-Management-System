document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#bookingForm');
    const message = document.querySelector('#formMessage');
    const dateInput = document.querySelector('#bookingDate');

    if (dateInput) {
        dateInput.min = new Date().toISOString().split('T')[0];
    }

    form?.addEventListener('submit', (event) => {
        event.preventDefault();
        const sport = document.querySelector('#sportType')?.value;

        if (!sport) {
            message.textContent = 'Vui lòng chọn môn thể thao để tiếp tục.';
            message.classList.add('text-danger');
            return;
        }

        window.location.href = `/dat-san?sport=${encodeURIComponent(sport)}`;
    });

    const bookingDate = document.querySelector('#bookingDate');
    const bookingDuration = document.querySelector('#bookingDuration');
    const filterCourts = document.querySelector('#filterCourts');
    const courtCards = [...document.querySelectorAll('.court-card')];
    const courtList = document.querySelector('#courtList');
    const filterMessage = document.querySelector('#filterMessage');
    const selectedSportLabel = document.querySelector('#selectedSportLabel');
    const summaryEmpty = document.querySelector('#summaryEmpty');
    const summarySelected = document.querySelector('#summarySelected');
    const selectedCourt = document.querySelector('#selectedCourt');
    const selectedLocation = document.querySelector('#selectedLocation');
    const selectedTime = document.querySelector('#selectedTime');
    const selectedDate = document.querySelector('#selectedDate');
    const selectedDuration = document.querySelector('#selectedDuration');
    const selectedPrice = document.querySelector('#selectedPrice');

    if (bookingDate && bookingDuration && filterCourts && courtCards.length) {
        const params = new URLSearchParams(window.location.search);
        const sportParam = params.get('sport');
        const dateParam = params.get('date');
        const today = new Date();
        const todayValue = today.toISOString().split('T')[0];
        const sportNames = {
            football: 'Bóng đá',
            badminton: 'Cầu lông',
            pickleball: 'Pickleball',
        };

        bookingDate.min = todayValue;
        bookingDate.value = dateParam || '';
        selectedSportLabel.textContent = sportNames[sportParam] || 'Chưa xác định';

        const updateResults = () => {
            let visibleCourts = 0;

            courtCards.forEach((card) => {
                const isVisible = card.dataset.sport.split(' ').includes(sportParam);
                card.classList.toggle('d-none', !isVisible);
                visibleCourts += isVisible ? 1 : 0;
            });

            courtList.classList.remove('d-none');
            filterMessage.textContent = visibleCourts
                ? `${visibleCourts} sân phù hợp đang có khung giờ trống.`
                : 'Hiện chưa có sân phù hợp với môn thể thao này.';
        };

        const formatDate = () => {
            if (!bookingDate.value) {
                return '—';
            }

            return new Date(`${bookingDate.value}T00:00:00`).toLocaleDateString('vi-VN', {
                weekday: 'short',
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
            });
        };

        const updateSummary = (button) => {
            const card = button.closest('.court-card');
            const courtName = card.querySelector('h3')?.textContent || 'Sân thể thao';
            const courtType = card.querySelector('.court-meta span')?.textContent.replace('▣ ', '') || 'Sân thể thao';
            const price = card.querySelector('.court-bottom strong')?.textContent.split('/')[0].trim() || '—';

            document.querySelectorAll('.time-slot.is-selected').forEach((slot) => {
                slot.classList.remove('is-selected');
            });
            button.classList.add('is-selected');
            selectedCourt.textContent = courtName;
            selectedLocation.textContent = `${sportNames[sportParam]} · ${courtType}`;
            selectedTime.textContent = button.dataset.time;
            selectedDate.textContent = formatDate();
            selectedDuration.textContent = `${bookingDuration.value} phút`;
            selectedPrice.textContent = price;
            summaryEmpty.classList.add('d-none');
            summarySelected.classList.remove('d-none');
        };

        document.querySelectorAll('.time-slot:not(.is-busy)').forEach((button) => {
            button.addEventListener('click', () => updateSummary(button));
        });

        document.querySelectorAll('.choose-court').forEach((button) => {
            button.addEventListener('click', () => {
                const firstAvailableSlot = button.closest('.court-card')?.querySelector('.time-slot:not(.is-busy)');

                firstAvailableSlot?.click();
                document.querySelector('#summarySelected')?.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            });
        });

        filterCourts.addEventListener('click', () => {
            if (!sportNames[sportParam]) {
                filterMessage.textContent = 'Vui lòng quay lại trang chủ để chọn môn thể thao.';
                filterMessage.classList.add('text-danger');
                return;
            }

            if (!bookingDate.value || !bookingDuration.value) {
                filterMessage.textContent = 'Vui lòng chọn ngày đặt sân và thời lượng chơi.';
                filterMessage.classList.add('text-danger');
                courtList.classList.add('d-none');
                return;
            }

            filterMessage.classList.remove('text-danger');
            updateResults();
        });
        bookingDate.addEventListener('change', () => {
            if (selectedDate && !summarySelected.classList.contains('d-none')) {
                selectedDate.textContent = formatDate();
            }

        });
        bookingDuration.addEventListener('change', () => {
            if (selectedDuration && !summarySelected.classList.contains('d-none')) {
                selectedDuration.textContent = `${bookingDuration.value} phút`;
            }
        });

    }

    const categoryButtons = [...document.querySelectorAll('.store-category-button')];
    const productColumns = [...document.querySelectorAll('.store-product-column')];
    const resultCount = document.querySelector('#storeResultCount');
    const emptyState = document.querySelector('#storeEmptyState');
    const cartCount = document.querySelector('#cartCount');
    const storeToast = document.querySelector('#storeToast');
    let cartItems = 0;

    categoryButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const selectedCategory = button.dataset.category;
            let visibleProducts = 0;

            categoryButtons.forEach((categoryButton) => {
                const isActive = categoryButton === button;
                categoryButton.classList.toggle('is-active', isActive);
                categoryButton.setAttribute('aria-selected', isActive ? 'true' : 'false');
            });

            productColumns.forEach((productColumn) => {
                const isVisible = selectedCategory === 'all' || productColumn.dataset.productCategory === selectedCategory;
                productColumn.classList.toggle('d-none', !isVisible);
                visibleProducts += isVisible ? 1 : 0;
            });

            if (resultCount) {
                resultCount.textContent = `${visibleProducts} sản phẩm`;
            }
            emptyState?.classList.toggle('d-none', visibleProducts > 0);
        });
    });

    document.querySelectorAll('.store-add-button').forEach((button) => {
        button.addEventListener('click', () => {
            cartItems += 1;
            if (cartCount) {
                cartCount.textContent = cartItems;
            }
            if (storeToast) {
                storeToast.textContent = `Đã thêm ${button.dataset.product} vào giỏ hàng.`;
                storeToast.classList.add('is-visible');
                window.setTimeout(() => storeToast.classList.remove('is-visible'), 2400);
            }
        });
    });
});
