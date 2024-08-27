@props(['active' => false ,'type' => 'a'])

<{{$type === 'a' ? 'a' : 'button' }} {{$attributes}} class="{{ $active ?' text-pm-dev':'text-white hover:text-pm-dev' }} rounded-md  px-3 py-2 text-lg font-medium"
aria-current="{{$active ? 'page' : 'false'}}">
{{$slot}}
</{{$type === 'a' ? 'a' : 'button' }}>
