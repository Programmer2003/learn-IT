function nextTask(e) {
    e.preventDefault();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: 'POST',
        url: '{{ route('task.next') }}',
        data: $(e.target).serialize(),
        dataType: "html",
        success: function (res) {
            if (res == '-1') {
                document.getElementById('test-tab').classList.remove("disabled");
                document.getElementById('task_text').innerHTML = 'Отлично, переходите к тесту!';
            } else {
                document.getElementById('task_text').innerHTML = res;
                timer();
            }

        },
        error: function (data) {
            console.log('error');
        }
    });
}