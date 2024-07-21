export default (taskItem) => {
  const taskId = taskItem.getAttribute('task-id');
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
  });
};