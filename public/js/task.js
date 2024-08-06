import template from './task/HTMLTemplate.js';

export default class {
  constructor({ id, task, is_done, deadline }) {
    this.id = id;
    this.task = task;
    this.isDone = is_done;
    this.deadline = deadline;
  };

  #renderHere = document.getElementById('task-table');

  render() {
    this.#renderHere.insertAdjacentHTML('beforeend', template({
      id: this.id,
      task: this.task,
      isDone: this.isDone,
      deadline: this.deadline,
    }));

    this.checkbox.addEventListener('change', () => {
      this.toggleDone();
    });

    this.textbox.addEventListener('change', () => {
      this.updateTask();
    });

    this.deleteButton.addEventListener('click', () => {
      this.remove();
      this.delete();
    });
  };

  get element() {
    return document.querySelector(`[task-id="${this.id}"]`);
  };

  get checkbox() {
    return this.element.querySelector('input[type="checkbox"]');
  };

  get textbox() {
    return this.element.querySelector('input[type="text"]');
  };

  get deleteButton() {
    return this.element.querySelector('img[delete]');
  };

  // API calls
  toggleDone() {
    if (!this.checkbox.checked) {
      this.textbox.classList.remove('line-through');
    } else {
      this.textbox.classList.add('line-through');
    };

    this.isDone = this.isDone === '0' ? '1' : '0';

    fetch(`/task/done/${this.id}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        taskId: this.id,
        isDone: this.checkbox.checked,
      }),
    });
  };

  updateTask() {
    this.task = this.textbox.value;

    fetch(`/task/${this.id}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        task: this.task,
      }),
    });
  };

  delete() {
    fetch(`/task/${this.id}`, {
      method: 'DELETE',
    });
  };

  // UI related methods
  hide() {
    this.element.style.display = 'none';
  };
  
  show() {
    this.element.style.display = 'table-row';
  };

  remove() {
    this.element.remove();
  };
};