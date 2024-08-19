import Base from './Base.js';
import template from './HTMLTemplate.js';

export default class extends Base {
  constructor(id, task, isDone, deadline, container, renderHere) {
    super(id, task, isDone, deadline);
    this.container = container;
    this.renderHere = document.getElementById(renderHere);
    Object.seal(this);
  };
  
  containerRemove() {
    this.container.remove(this.id);
  };

  render() {
    this.renderHere.insertAdjacentHTML('beforeend', template({
      id: this.id,
      task: this.task,
      isDone: this.isDone,
      deadline: this.deadline,
    }));

    this.checkbox.addEventListener('change', () => {
      this.toggleDonenFetch();
      this.toggleStrikeThrough();
      this.checkbox.dispatchEvent(new CustomEvent(
        'toggleDone', { detail: {task: this}, bubbles: true }
      ));
    });

    this.textbox.addEventListener('change', () => {
      this.updateTasknFetch();
    });

    this.deleteButton.addEventListener('click', () => {
      this.DOMRemove();
      this.containerRemove();
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

  // API calls & data manipulation methods
  toggleDonenFetch() {
    this.toggleDone();

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

  updateTasknFetch() {
    this.updateTask(this.textbox.value);

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
  toggleStrikeThrough() {
    if (!this.checkbox.checked) {
      this.textbox.classList.remove('line-through');
    } else {
      this.textbox.classList.add('line-through');
    };
  };

  hide() {
    this.element.style.display = 'none';
  };
  
  show() {
    this.element.style.display = 'table-row';
  };

  DOMRemove() {
    this.element.remove();
  };
};