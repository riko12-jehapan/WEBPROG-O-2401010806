<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Data Mahasiswa KKN CRUD</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
</head>
<body class="bg-gray-50 min-h-screen p-6 flex flex-col items-center">
  <h1 class="text-2xl font-semibold mb-6">Data Mahasiswa KKN</h1>

  <form id="form" class="w-full max-w-md bg-white p-6 rounded shadow mb-8">
    <input type="hidden" id="editIndex" value="" />
    <div class="mb-4">
      <label for="nama" class="block mb-1 font-medium">Nama</label>
      <input
        id="nama"
        name="nama"
        type="text"
        class="w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        required
      />
    </div>

    <div class="mb-4">
      <label for="nim" class="block mb-1 font-medium">NIM</label>
      <input
        id="nim"
        name="nim"
        type="text"
        class="w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        required
      />
    </div>

    <div class="mb-4">
      <label for="alamat" class="block mb-1 font-medium">Alamat</label>
      <input
        id="alamat"
        name="alamat"
        type="text"
        class="w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        required
      />
    </div>
    <div class="mb-4">
      <label for="alamat" class="block mb-1 font-medium">Email</label>
      <input
        id="email"
        name="email"
        type="text"
        class="w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        required
      />
    </div>
    <div class="mb-4">
      <label for="alamat" class="block mb-1 font-medium">Tempat/tgl</label>
      <input
        id="tempat tanggal lahir"
        name="tempat tanggal lahir"
        type="text"
        class="w-full border border-gray-400 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
        required
      />
    </div>


    <fieldset class="mb-4">
      <legend class="font-medium mb-2">Jenis Kelamin</legend>
      <label class="inline-flex items-center mr-6">
        <input
          type="radio"
          name="jenis_kelamin"
          value="Laki"
          class="accent-blue-600"
          required
        />
        <span class="ml-2">Laki</span>
      </label>
      <label class="inline-flex items-center">
        <input
          type="radio"
          name="jenis_kelamin"
          value="Perempuan"
          class="accent-blue-600"
          required
        />
        <span class="ml-2">Perempuan</span>
      </label>
    </fieldset>

    <button
      type="submit"
      class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition"
    >
      Simpan Data
    </button>
  </form>

  <div class="w-full max-w-3xl bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Daftar Mahasiswa</h2>
    <table class="w-full border-collapse border border-gray-300 text-left">
      <thead>
        <tr class="bg-gray-100">
          <th class="border border-gray-300 px-3 py-2">No</th>
          <th class="border border-gray-300 px-3 py-2">Nama</th>
          <th class="border border-gray-300 px-3 py-2">NIM</th>
          <th class="border border-gray-300 px-3 py-2">EMAIL</th>
          <th class="border border-gray-300 px-3 py-2">Alamat</th>
          <th class="border border-gray-300 px-3 py-2">Tempat/tgl</th>
          <th class="border border-gray-300 px-3 py-2">Jenis Kelamin</th>
          <th class="border border-gray-300 px-3 py-2">Aksi</th>
        </tr>
      </thead>
      <tbody id="mahasiswaList" class="divide-y divide-gray-200"></tbody>
    </table>
  </div>

  <script>
    const form = document.getElementById('form');
    const mahasiswaList = document.getElementById('mahasiswaList');
    const editIndexInput = document.getElementById('editIndex');

    let dataMahasiswa = [];

    function renderTable() {
      mahasiswaList.innerHTML = '';
      dataMahasiswa.forEach((mhs, index) => {
        const tr = document.createElement('tr');
        tr.classList.add('hover:bg-gray-50');
        tr.innerHTML = `
          <td class="border border-gray-300 px-3 py-2">${index + 1}</td>
          <td class="border border-gray-300 px-3 py-2">${mhs.nama}</td>
          <td class="border border-gray-300 px-3 py-2">${mhs.nim}</td>
          <td class="border border-gray-300 px-3 py-2">${mhs.email}</td>
          <td class="border border-gray-300 px-3 py-2">${mhs.alamat}</td>
          <td class="border border-gray-300 px-3 py-2">${mhs.tempat/tgl}</td>
          <td class="border border-gray-300 px-3 py-2">${mhs.jenis_kelamin}</td>
          <td class="border border-gray-300 px-3 py-2 space-x-2">
            <button data-index="${index}" class="edit-btn text-blue-600 hover:underline">Edit</button>
            <button data-index="${index}" class="delete-btn text-red-600 hover:underline">Delete</button>
          </td>
        `;
        mahasiswaList.appendChild(tr);
      });

      // Attach event listeners for edit and delete buttons
      document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', e => {
          const idx = e.target.getAttribute('data-index');
          loadEditForm(idx);
        });
      });

      document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', e => {
          const idx = e.target.getAttribute('data-index');
          deleteData(idx);
        });
      });
    }

    function loadEditForm(index) {
      const mhs = dataMahasiswa[index];
      document.getElementById('nama').value = mhs.nama;
      document.getElementById('nim').value = mhs.nim;
      document.getElementById('email').value = mhs.email;
      document.getElementById('alamat').value = mhs.alamat;
      document.getElementById('tempat/tgl').value = mhs.tempat/tgl;
      const radios = document.getElementsByName('jenis_kelamin');
      radios.forEach(radio => {
        radio.checked = radio.value === mhs.jenis_kelamin;
      });
      editIndexInput.value = index;
    }

    function deleteData(index) {
      if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        dataMahasiswa.splice(index, 1);
        renderTable();
        form.reset();
        editIndexInput.value = '';
      }
    }

    form.addEventListener('submit', e => {
      e.preventDefault();
      const nama = document.getElementById('nama').value.trim();
      const nim = document.getElementById('nim').value.trim();
      const email = document.getElementById('email').value.trim();
      const alamat = document.getElementById('alamat').value.trim();
      const alamat = document.getElementById('tempat/tgl').value.trim();
      const jenis_kelamin = [...document.getElementsByName('jenis_kelamin')].find(r => r.checked)?.value;

      if (!nama || !nim ||!email|| !alamat ||!tempat/tgl|| !jenis_kelamin) {
        alert('Semua field harus diisi!');
        return;
      }

      const editIndex = editIndexInput.value;

      if (editIndex === '') {
        // Create new
        dataMahasiswa.push({ nama, nim, email, alamat,tempattanggallahir, jenis_kelamin });
      } else {
        // Update existing
        dataMahasiswa[editIndex] = { nama, nim, email ,alamat, , tempattanggallahir ,jenis_kelamin };
      }

      renderTable();
      form.reset();
      editIndexInput.value = '';
    });

    renderTable();
  </script>
</body>
</html