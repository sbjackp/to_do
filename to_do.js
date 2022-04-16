$(() => {

    let error = $('#error')

    $(document).on('click', '#btn', (e) => {

        e.preventDefault();

        error.text('');
    
        const task = $('#list').val();

        if(task == '') {
            console.log('タスクを入力して下さい');
            error.text('タスクを入力して下さい');
            return;
        } else if(task.length >= 10) {
            console.log('タスクは10文字以内で入力して下さい');
            error.text('タスクは10文字以内で入力して下さい');
            return;
        }

        console.log(task);
        console.log('クリックされました');

        $.ajax({
            type: "POST",
            url: "to_do.php",
            data: { "task" : task },
            dataType : "json"
          }).done(function(response){
            // JSONを文字列に
            console.log(JSON.stringify(response));
            console.log('成功');

            if(response.status == 'success'){
              console.log(response.message)
            } else {
              console.log(response.message)
            }

          }).fail(function(XMLHttpRequest, status, e){
            alert(e);
          });

          location.reload();


    });


    const init = () => {

      // AjaxでDBからタスクを全取得
      $.ajax({
        type: "GET",
        url: "to_do_get.php",
        dataType:"json",
      }).done(function(response){
        
        const tasks = (response);
        console.log(tasks);
        
        const task_list = $('#task_list')
        task_list.empty();
    
        for(let i=0; i<tasks.length; i++) {
          console.log(typeof(tasks[i].done));
          
          // const Litag = '<li>' + tasks[i].id + '　：　' + tasks[i].task + '<button class="done_btn" data-id="' + tasks[i].id + '">完了</button></li>';
          let Litag = "";

          if(tasks[i].done === "1") {
            Litag = `<li class="task_line">${tasks[i].id} ： ${tasks[i].task} <button class="done_btn" data-id="${tasks[i].id}">完了</button> <button class="delete_btn" data-id="${tasks[i].id}">削除</button></li>`;
          } else {
            Litag = `<li>${tasks[i].id} ： ${tasks[i].task} <button class="done_btn" data-id="${tasks[i].id}">完了</button> <button class="delete_btn" data-id="${tasks[i].id}">削除</button></li>`;
          }
          

          task_list.append(Litag);


          // $('.1').addClass('task_line');
          // $('.0').removeClass('task_line');

          



          // if(tasks[i].done = 1) {
          //   $('li').addClass('task_line');
          // } else {
          //   $('li').removeClass('task_line')
          // }
            

        }


      }).fail(function(XMLHttpRequest, status, e){
          alert(e);
      });
    
    }

    $(document).on('click', '.done_btn', (e) => {

      const id = e.target.getAttribute('data-id');

      console.log(e.target);
      console.log(id);

      $.ajax({
        type: "POST",
        url: "to_do_done.php",
        data: { "id" : id },
        dataType : "json"
      }).done(function(response){
        console.log('成功')
        console.log(response);

        init();

        


      }).fail(function(XMLHttpRequest, status, e){
        alert(e);
      });

      

    });


    $(document).on('click', '.delete_btn', (e) => {

      const id = e.target.getAttribute('data-id');

      console.log(e.target);
      console.log(id);

      $.ajax({
        type: "POST",
        url: "to_do_delete.php",
        data: { "id" : id },
      }).done(function(){
        console.log('成功')
        location.reload();
        
      }).fail(function(XMLHttpRequest, status, e){
        alert(e);
      });

    });



    init();

    
    











});