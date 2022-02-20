@props(['isoDatetime'])

<span x-data="{
    left: '',
}" x-init="$nextTick(() => {
    left = window.relativeTimeLeft('{{ $isoDatetime }}');
    $interval(() => {left = window.relativeTimeLeft('{{ $isoDatetime }}')}, 1000)
})" x-text="left"></span>
