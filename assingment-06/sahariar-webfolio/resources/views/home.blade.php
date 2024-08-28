@props(['projects'])
<x-layout>
<x-homeheader> </x-homeheader>
<x-about-section> </x-about-section>
<x-timeline> </x-timeline>
<x-project  :projects="$projects"> </x-project>
<x-skill></x-skill>
<x-testimonial-section> </x-testimonial-section>
</x-layout>
