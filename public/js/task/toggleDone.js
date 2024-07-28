export default (taskId, callback) => {
  const taskItem = document.querySelector(`[task-id="${taskId}"]`);
  // strike through when checked
  const checkbox = taskItem.querySelector('input[type="checkbox"]');
  const textbox = taskItem.querySelector('input[type="text"]');

  checkbox.addEventListener('change', () => {
    if (!checkbox.checked) {
      textbox.classList.remove('line-through');
    } else {
      textbox.classList.add('line-through');
    };

    fetch(`/task/done/${taskId}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        taskId,
        isDone: checkbox.checked,
      }),
    });

    callback();
  });
};