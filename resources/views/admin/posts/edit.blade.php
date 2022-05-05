@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-10">
                <h1>Modifica Post: {{ $post->title }}</h1>
            </div>
            <div class="col-2">
                <form id="delete-form" action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button for="delete-form" class="btn btn-danger" type="submit">Elimina</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">

        <form id="edit" action="{{ route('admin.posts.update', $post) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
              <label for="title">Titolo*</label>
              <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}" placeholder="Inserisci il titolo" aria-describedby="emailHelp">
              @error('title')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Seleziona Categoria</label>
                <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                  <option value="">-- nessuna --</option>
                  @foreach ($categories as $category)
                      <option {{ old('category_id', optional($post->category)->id) == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <label>Tags</label>
            <div class="d-flex" style="gap: 1.25rem;">
                @foreach ($tags as $tag)
                    
                    <div class="form-group form-check">
                        <input type="checkbox" {{ $post->tags->contains($tag) ? 'checked' : '' }} class="form-check-input" value="{{ $tag->id }}" id="tags-{{ $tag->id }}" name="tags[]">
                        <label class="form-check-label" for="tags-{{ $tag->id }}">{{ $tag->name }}</label>
                    </div>
    
                @endforeach
                @error('tags')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Contenuto*</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3" placeholder="Inserisci il contenuto">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="published_at">Data di pubblicazione</label>
                <input type="date" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at') ?: Str::substr($post->published_at, 0, 10) }}" aria-describedby="emailHelp">
                @error('published_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

            <button type="submit" for="edit" class="btn btn-primary">Salva</button>

        </form>

    </div>
    
@endsection