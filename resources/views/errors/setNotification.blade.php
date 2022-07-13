<script>
    window.localStorage.setItem("{{ $method }}", "{{ $message }}")
    window.location.href = "{{ url($url) }}"
</script>
