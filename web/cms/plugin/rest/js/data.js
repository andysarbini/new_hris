// place for dummy data
var d_user = [
	{
		"id":"1",
		"name":"Indradhi Mulayana",
		"nip": "KAS8765",
		"username":"indradhi",
		"group":"1",
		"kereta":"1"
	},
	{
		"id":"2",
		"name":"Denly Parulian",
		"nip": "KAS12345",
		"username":"denly",
		"group":"3",
		"kereta":"2"
	},
	{
		"id":"1",
		"name":"Indradhi Mulayana",
		"nip": "KAS8765",
		"username":"indradhi",
		"group":"1",
		"kereta":"1"
	},
	{
		"id":"2",
		"name":"Denly Parulian",
		"nip": "KAS12345",
		"username":"denly",
		"group":"3",
		"kereta":"2"
	},
	{
		"id":"1",
		"name":"Indradhi Mulayana",
		"nip": "KAS8765",
		"username":"indradhi",
		"group":"1",
		"kereta":"1"
	},
	{
		"id":"2",
		"name":"Denly Parulian",
		"nip": "KAS12345",
		"username":"denly",
		"group":"3",
		"kereta":"2"
	},
	{
		"id":"1",
		"name":"Indradhi Mulayana",
		"nip": "KAS8765",
		"username":"indradhi",
		"group":"1",
		"kereta":"1"
	},
	{
		"id":"2",
		"name":"Denly Parulian",
		"nip": "KAS12345",
		"username":"denly",
		"group":"3",
		"kereta":"2"
	},
	{
		"id":"1",
		"name":"Indradhi Mulayana",
		"nip": "KAS8765",
		"username":"indradhi",
		"group":"1",
		"kereta":"1"
	},
	{
		"id":"2",
		"name":"Denly Parulian",
		"nip": "KAS12345",
		"username":"denly",
		"group":"3",
		"kereta":"2"
	}
];

// setup value group
var slc_group = [
	{"id":"1","text":"Pramugari"},
	{"id":"2","text":"Waiter"},
	{"id":"3","text":"Koki"},
];

// setup value kereta
var slc_kereta = [
	{"id":"1","text":"Mutiara Selatan"},
	{"id":"2","text":"Argo Bromo"},
	{"id":"3","text":"Sapu Jagad"},
];


var d_kereta = [
	{
		"id":"1",
		"nama":"Mutiara Selatan",
		"nomor":"111",
		"kota_awal":"Bandung",
		"kota_tujuan":"Malang",
		"jam_berangkat":"12:00",
		"jam_tiba":"20:00"
	},
	{
		"id":"2",
		"nama":"Mutiara Selatan",
		"nomor":"112",
		"kota_awal":"Jakarta",
		"kota_tujuan":"Malang",
		"jam_berangkat":"13:00",
		"jam_tiba":"21:00"
	},
	{
		"id":"1",
		"nama":"Mutiara Selatan",
		"nomor":"111",
		"kota_awal":"Bandung",
		"kota_tujuan":"Malang",
		"jam_berangkat":"12:00",
		"jam_tiba":"20:00"
	},
	{
		"id":"2",
		"nama":"Mutiara Selatan",
		"nomor":"112",
		"kota_awal":"Jakarta",
		"kota_tujuan":"Malang",
		"jam_berangkat":"13:00",
		"jam_tiba":"21:00"
	},
	{
		"id":"1",
		"nama":"Mutiara Selatan",
		"nomor":"111",
		"kota_awal":"Bandung",
		"kota_tujuan":"Malang",
		"jam_berangkat":"12:00",
		"jam_tiba":"20:00"
	},
	{
		"id":"2",
		"nama":"Mutiara Selatan",
		"nomor":"112",
		"kota_awal":"Jakarta",
		"kota_tujuan":"Malang",
		"jam_berangkat":"13:00",
		"jam_tiba":"21:00"
	},
	{
		"id":"1",
		"nama":"Mutiara Selatan",
		"nomor":"111",
		"kota_awal":"Bandung",
		"kota_tujuan":"Malang",
		"jam_berangkat":"12:00",
		"jam_tiba":"20:00"
	},
	{
		"id":"2",
		"nama":"Mutiara Selatan",
		"nomor":"112",
		"kota_awal":"Jakarta",
		"kota_tujuan":"Malang",
		"jam_berangkat":"13:00",
		"jam_tiba":"21:00"
	}
];

var d_produk = [
	{
		"id":"1",
		"produk":"Nasi Goreng",
		"alias":"Fried Rice",
		"sku":"",
		"barcode":"",
		"kategori":"",
		"gambar":"",
		"satuan":"menu",
		"harga":20000
	},
	{
		"id":"2",
		"produk":"Omelet",
		"alias":"omelet",
		"sku":"",
		"barcode":"",
		"kategori":"",
		"gambar":"",
		"satuan":"menu",
		"harga":10000
	},
	{
		"id":"3",
		"produk":"Mie Goreng",
		"alias":"Fried Nodle",
		"sku":"",
		"barcode":"",
		"kategori":"",
		"gambar":"",
		"satuan":"menu",
		"harga":23000
	},
	{
		"id":"4",
		"produk":"Mie Goreng Seafod",
		"alias":"Seafod Nodle",
		"sku":"",
		"barcode":"",
		"kategori":"",
		"gambar":"",
		"satuan":"menu",
		"harga":23000
	},
	{
		"id":"5",
		"produk":"Telur",
		"alias":"telur",
		"sku":"",
		"barcode":"",
		"kategori":"",
		"gambar":"",
		"satuan":"menu",
		"harga":1000
	}
];

var slc_produk_kategori = [
	{"id":"1","text":"Makanan"},
	{"id":"2","text":"Minuman"},
	{"id":"3","text":"Desert"},
	{"id":"4","text":"Pelengkap"}
];

var slc_produk_satuan = [
	{"id":"1","text":"Pieces"},
	{"id":"2","text":"Piring"},
	{"id":"3","text":"Gelas"}
];

var slc_produk_dijual = [
	{"id":"1","text":"Ya"},
	{"id":"2","text":"Tidak"}
];

// produk per Kereta

var slc_perkereta = [
	{"id":"1", "text":"Mutiara Selatan 112"},
	{"id":"2", "text":"Sembrani"},
	{"id":"3", "text":"Taksaka"}
];


var d_perkereta = [
		[],
			[
				{
					"produk":"Nasi Goreng",
					"alias":"Fried Rice",
					"gambar":"",
					"harga":"20.000",
					"tipe":"ala carte",
					"tersedia":"1"
				},
				{
					"produk":"Omelet",
					"alias":"Omelet",
					"gambar":"",
					"harga":"1.000",
					"tipe":"instant",
					"tersedia":"0"
				},
				{
					"produk":"Mie Goreng",
					"alias":"Fried Noodle",
					"gambar":"",
					"harga":"20.000",
					"tipe":"ala carte",
					"tersedia":"1"
				},
				{
					"produk":"Mie Goreng Seafod",
					"alias":"Fried Noodle Seafod",
					"gambar":"",
					"harga":"25.000",
					"tipe":"ala carte",
					"tersedia":"0"
				},
				{
					"produk":"Mie Goreng Kambing",
					"alias":"Fried Noodle",
					"gambar":"",
					"harga":"20.000",
					"tipe":"instant",
					"tersedia":"1"
				}
			],[
				{
					"produk":"Nasi Goreng",
					"alias":"Fried Rice",
					"gambar":"",
					"harga":"20.000",
					"tipe":"ala carte",
					"tersedia":"0"
				},
				{
					"produk":"Omelet",
					"alias":"Omelet",
					"gambar":"",
					"harga":1000,
					"tipe":"instant",
					"tersedia":0
				},
				{
					"produk":"Mie Goreng",
					"alias":"Fried Noodle",
					"gambar":"",
					"harga":20000,
					"tipe":"ala carte",
					"tersedia":1
				},
				{
					"produk":"Mie Goreng Seafod",
					"alias":"Fried Noodle Seafod",
					"gambar":"",
					"harga":25000,
					"tipe":"ala carte",
					"tersedia":0
				},
				{
					"produk":"Mie Goreng Kambing",
					"alias":"Fried Noodle",
					"gambar":"",
					"harga":20000,
					"tipe":"instant",
					"tersedia":1
				}
			],[
				{
					"produk":"Nasi Goreng",
					"alias":"Fried Rice",
					"gambar":"",
					"harga":20000,
					"tipe":"ala carte",
					"tersedia":1
				},
				{
					"produk":"Omelet",
					"alias":"Omelet",
					"gambar":"",
					"harga":1000,
					"tipe":"instant",
					"tersedia":0
				},
				{
					"produk":"Mie Goreng",
					"alias":"Fried Noodle",
					"gambar":"",
					"harga":20000,
					"tipe":"ala carte",
					"tersedia":1
				},
				{
					"produk":"Mie Goreng Seafod",
					"alias":"Fried Noodle Seafod",
					"gambar":"",
					"harga":25000,
					"tipe":"ala carte",
					"tersedia":0
				},
				{
					"produk":"Mie Goreng Kambing",
					"alias":"Fried Noodle",
					"gambar":"",
					"harga":20000,
					"tipe":"instant",
					"tersedia":0
				}
			]
	];

//  stock
/*
produk
kategori
tglupdate
satuan
jumlah
spark
*/

var d_stock = [
	[],
	[
		{ "produk":"Bawang Putih", "kategori":"Bumbu", "tglupdate":"27/12/2017", "satuan":"kilo", "jumlah":"10", "spark":"10,8,7,4,10"},
		{ "produk":"Garam", "kategori":"Bumbu", "tglupdate":"26/12/2017", "satuan":"bungkus 100g", "jumlah":"3", "spark":"5,4,3"},
		{ "produk":"Beras", "kategori":"Sembako", "tglupdate":"27/12/2017", "satuan":"kilo", "jumlah":"35", "spark":"50,48,42,37,35"},
		{ "produk":"Minyak", "kategori":"Sembako", "tglupdate":"27/12/2017", "satuan":"liter", "jumlah":"3", "spark":"10,8,7,6,3"},
	],
	[
		{ "produk":"Bawang Putih", "kategori":"Bumbu", "tglupdate":"27/12/2017", "satuan":"kilo", "jumlah":"10", "spark":"10,8,7,4,10"},
		{ "produk":"Garam", "kategori":"Bumbu", "tglupdate":"26/12/2017", "satuan":"bungkus 100g", "jumlah":"3", "spark":"5,4,3"},
		{ "produk":"Beras", "kategori":"Sembako", "tglupdate":"27/12/2017", "satuan":"kilo", "jumlah":"35", "spark":"50,48,42,37,35"},
		{ "produk":"Daun Sawi", "kategori":"Sayuran", "tglupdate":"27/12/2017", "satuan":"kilo", "jumlah":"3", "spark":"10,8,7,6,3"},
		{ "produk":"Minyak", "kategori":"Sembako", "tglupdate":"27/12/2017", "satuan":"liter", "jumlah":"3", "spark":"10,8,7,6,3"},
	],
	[
		{ "produk":"Bawang Putih", "kategori":"Bumbu", "tglupdate":"27/12/2017", "satuan":"kilo", "jumlah":"10", "spark":"10,8,7,4,10"},
		{ "produk":"Garam", "kategori":"Bumbu", "tglupdate":"26/12/2017", "satuan":"bungkus 100g", "jumlah":"3", "spark":"5,4,3"},
		{ "produk":"Telur", "kategori":"Lauk", "tglupdate":"27/12/2017", "satuan":"kilo", "jumlah":"15", "spark":"25,30,20,15"},
		{ "produk":"Beras", "kategori":"Sembako", "tglupdate":"27/12/2017", "satuan":"kilo", "jumlah":"35", "spark":"50,48,42,37,35"},
		{ "produk":"Daun Sawi", "kategori":"Sayuran", "tglupdate":"27/12/2017", "satuan":"kilo", "jumlah":"3", "spark":"10,8,7,6,3"},
		{ "produk":"Minyak", "kategori":"Sembako", "tglupdate":"27/12/2017", "satuan":"liter", "jumlah":"3", "spark":"10,8,7,6,3"},
	]
];
