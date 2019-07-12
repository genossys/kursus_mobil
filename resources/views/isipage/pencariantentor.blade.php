<div class="m-2">
    <div class="row pt-3">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Tentor</th>
                    <th>Tanggal Lahir</th>
                    <th>biodata</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($dataTentor as $dm)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$dm->namaTentor}}</td>
                    <td>{{$dm->tanggalLahir}}</td>
                    <td>{{$dm->biodata}}</td>
                    <td>
                        <button class="btn btn-info btn-sm pull-right" onclick="pilihTentor('{{$dm->idTentor}}','{{$dm->namaTentor}}')" data-toggle="modal" data-target="#modalTentor"> <i class="fa fa-check"> pilih</i> </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>


</div>


<script>
    function pilihTentor(id, nama) {
        $('#reqTentor').val(id);
        $('#namaTentor').val(nama);
    }
</script>

