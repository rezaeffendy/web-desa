@php
$berita = \App\Models\Berita::latest()->paginate(6);
@endphp

<div class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="card-title m-0 text-bold">Berita</h5>
    </div>
    <div class="card-body">
        @foreach ($berita as $berita)
            <table id="ul-menu">
                <tr>
                    <td colspan="2">
                        <span class="meta_date">{{ date('d F Y', strtotime($berita->created_at)) }}</span>
                    </td>
                </tr>
                <tr>
                    <td valign="top" align="justify">
                        <a href="{{ url('berita/' . $berita->slug) }}">
                            <img width="25%" style="float:left; margin:0 8px 4px 0;" class="img-fluid img-thumbnail"
                                src="{{ url('storage/' . $berita->gambar) }}" />
                            <small>
                                <font color="green">{{ $berita->judul }}</font>
                            </small>
                        </a>
                    </td>
                </tr>
            </table>
        @endforeach
    </div>
</div>
