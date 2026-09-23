let requestCounter = 0;

function showHint(str) {
    if (str.length === 0) {
        document.getElementById('txtHint').innerHTML = '';
        return;
    }

    const currentRequest = ++requestCounter;

    fetch('/publikasi-hint?keyword=' + encodeURIComponent(str))
        .then(response => response.json())
        .then(data => {
            // Kalau ada request yang lebih baru udah dikirim setelah ini,
            // abaikan hasil yang telat ini biar nggak menimpa hasil terbaru
            if (currentRequest !== requestCounter) {
                return;
            }

            let hasil;
            if (data.length === 1 && data[0].judul === 'no suggestion') {
                hasil = 'no suggestion';
            } else {
                hasil = data
                    .map(item => `<span class="hint-item" style="cursor:pointer; text-decoration:underline; color:#1d4ed8;" onclick="scrollToPublikasi(${item.id})">${item.judul}</span>`)
                    .join(', ');
            }
            document.getElementById('txtHint').innerHTML = hasil;
        });
}

function scrollToPublikasi(id) {
    const row = document.getElementById('pub-' + id);
    if (!row) return;

    row.scrollIntoView({ behavior: 'smooth', block: 'center' });
    row.style.transition = 'background-color 0.3s ease';
    row.style.backgroundColor = '#bfdbfe';

    setTimeout(() => {
        row.style.backgroundColor = '';
    }, 4000);
}

window.showHint = showHint;
window.scrollToPublikasi = scrollToPublikasi;