<x-layout>
        <a href="{{route('dashboard')}}" class="block mb-2 text-xs text-blue-500">&larrhk; Dashboard</a>
    <div class="card">
        <h2 class="font-bold mb-4"> Update your post</h2>

        <form action="{{ route('posts.update', $post)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{-- Post title --}}
        <div class="mb-4">
                <label for="title">Post title</label>
                <input type="text" name="title" value="{{ $post->title }}"
                class="input @error('title') ring-red-500 @enderror">
                @error('title')
                   <p class="error">{{ $message }}</p> 
                @enderror
        </div>
        {{-- Content --}}
        <div class="mb-4">
                <label for="body">Content</label>
                <textarea name="body" rows="5" 
                class="input @error('body') ring-red-500" @enderror">{{ $post->body}}</textarea>
                @error('body')
                   <p class="error">{{ $message }}</p> 
                @enderror
        </div>

         {{--Image upload --}}
         @if ($post->image_path)
                <label>Current image</label>
                <div class="h-64 rounded-md mb-4 w-1/4 object-cover overflow-hidden">
                        <img src="{{asset('storage/'.$post->image_path)}}" alt="post_img">
                </div>
         @endif
         <input type="file" name="image" id="image">
                        @error('image')
                           <p class="error">{{ $message }}</p> 
                        @enderror

        {{-- Update btn --}}
        <button class="primary-btn">Update</button>

        </form>
</div>
</x-layout>