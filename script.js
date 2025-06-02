// Data Produk
const produkData = [
    {
        id: 1,
        nama: "Kursi Modern",
        harga: 1500000,
        gambar: "images/kursi.jpeg",
        kategori: "kursi",
        deskripsi: "Kursi modern dengan desain minimalis, nyaman digunakan, dan cocok untuk berbagai interior rumah."
    },
    {
        id: 2,
        nama: "Meja Kayu",
        harga: 2000000,
        gambar: "images/meja.jpeg",
        kategori: "meja",
        deskripsi: "Meja kayu solid dengan finishing berkualitas tinggi, tahan lama dan elegan."
    },
    {
        id: 3,
        nama: "Sofa Minimalis",
        harga: 3500000,
        gambar: "images/sofa.jpeg",
        kategori: "sofa",
        deskripsi: "Sofa minimalis dengan bahan berkualitas tinggi dan desain yang stylish."
    },
    {
        id: 4,
        nama: "Lemari Pakaian",
        harga: 4000000,
        gambar: "images/lemari.jpeg",
        kategori: "lemari",
        deskripsi: "Lemari pakaian dengan kapasitas besar dan desain modern."
    },
    {
        id: 5,
        nama: "Kursi Kantor",
        harga: 1200000,
        gambar: "images/kursi2.jpg",
        kategori: "kursi",
        deskripsi: "Kursi kantor ergonomis dengan penyangga punggung yang nyaman."
    },
    {
        id: 6,
        nama: "Meja Makan",
        harga: 2500000,
        gambar: "images/kursimakan.jpg",
        kategori: "meja",
        deskripsi: "Meja makan untuk 6 orang dengan bahan kayu jati berkualitas."
    },
    {
        id: 7,
        nama: "Meja Estetic",
        harga: 2500000,
        gambar: "images/kursi3.jpg",
        kategori: "meja",
        deskripsi: "Meja makan estetic untuk ruangan"
    },
    {
        id: 8,
        nama: "Lemari Simpel",
        harga: 2500000,
        gambar: "images/lemariterbuka.jpg",
        kategori: "lemari",
        deskripsi: "Lemari simpel terbuka tanpa pintu."
    }
];

// Inisialisasi Keranjang
let cart = JSON.parse(localStorage.getItem('cart')) || [];
let loggedInUser = JSON.parse(localStorage.getItem('loggedInUser'));

// Fungsi untuk memuat produk
function loadProduk(kategori = 'all') {
    const produkContainer = document.getElementById('produkContainer');
    produkContainer.innerHTML = '';

    const filteredProduk = kategori === 'all' 
        ? produkData 
        : produkData.filter(produk => produk.kategori === kategori);

    if (filteredProduk.length === 0) {
        produkContainer.innerHTML = '<p class="no-product">Tidak ada produk dalam kategori ini.</p>';
        return;
    }

    filteredProduk.forEach(produk => {
        const produkItem = document.createElement('div');
        produkItem.className = 'produk-item';
        produkItem.innerHTML = `
            <a href="detail-produk.html?id=${produk.id}">
                <img src="${produk.gambar}" alt="${produk.nama}">
                <h3>${produk.nama}</h3>
                <p class="price">Rp ${produk.harga.toLocaleString('id-ID')}</p>
            </a>
            <button onclick="addToCart(event, ${produk.id})">
                <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
            </button>
        `;
        produkContainer.appendChild(produkItem);
    });
}

// Fungsi untuk menambahkan ke keranjang
function addToCart(event, productId) {
    event.preventDefault();
    event.stopPropagation();
    
    const product = produkData.find(p => p.id === productId);
    const existingItem = cart.find(item => item.id === productId);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: product.id,
            nama: product.nama,
            harga: product.harga,
            gambar: product.gambar,
            quantity: 1
        });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
    showNotification(`${product.nama} telah ditambahkan ke keranjang!`);
}

// Fungsi untuk memperbarui jumlah keranjang
function updateCartCount() {
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    document.querySelectorAll('#cart-count, #floating-cart-count').forEach(el => {
        el.textContent = totalItems;
    });
}

// Fungsi untuk filter kategori
function filterKategori(kategori) {
    // Update active class
    document.querySelectorAll('.kategori-item').forEach(item => {
        item.classList.remove('active');
    });
    event.target.classList.add('active');
    
    loadProduk(kategori);
}

// Fungsi untuk menampilkan notifikasi
function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Fungsi untuk toggle navbar mobile
function toggleNav() {
    const navLinks = document.getElementById('navLinks');
    navLinks.classList.toggle('active');
}

// Fungsi untuk pencarian produk
document.getElementById('search').addEventListener('keyup', function(event) {
    if (event.key === 'Enter') {
        const query = this.value.toLowerCase();
        const filtered = produkData.filter(produk => 
            produk.nama.toLowerCase().includes(query) || 
            produk.deskripsi.toLowerCase().includes(query)
        );
        
        if (filtered.length > 0) {
            const produkContainer = document.getElementById('produkContainer');
            produkContainer.innerHTML = '';
            
            filtered.forEach(produk => {
                const produkItem = document.createElement('div');
                produkItem.className = 'produk-item';
                produkItem.innerHTML = `
                    <a href="detail-produk.html?id=${produk.id}">
                        <img src="${produk.gambar}" alt="${produk.nama}">
                        <h3>${produk.nama}</h3>
                        <p class="price">Rp ${produk.harga.toLocaleString('id-ID')}</p>
                    </a>
                    <button onclick="addToCart(event, ${produk.id})">
                        <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                    </button>
                `;
                produkContainer.appendChild(produkItem);
            });
        } else {
            document.getElementById('produkContainer').innerHTML = 
                '<p class="no-product">Produk tidak ditemukan.</p>';
        }
    }
});

// Fungsi untuk memeriksa status login
function checkLoginStatus() {
    const loginLink = document.getElementById('login-link');
    
    if (loggedInUser) {
        loginLink.innerHTML = `<a href="#" onclick="logout()">Logout (${loggedInUser.username})</a>`;
    } else {
        loginLink.innerHTML = '<a href="login.html">Login</a>';
    }
}

// Fungsi untuk logout
function logout() {
    localStorage.removeItem('loggedInUser');
    loggedInUser = null;
    checkLoginStatus();
    window.location.href = "index.html";
}

// Inisialisasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    loadProduk();
    updateCartCount();
    checkLoginStatus();
    
    // Set active kategori "Semua"
    document.querySelector('.kategori-item').classList.add('active');
});