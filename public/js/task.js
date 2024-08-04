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
      deadline: this.deadline
    }));
  };

  get element() {
    return document.querySelector(`[task-id="${this.id}"]`);
  }

  toggleDone() {
    this.isDone = this.isDone === 0 ? 1 : 0;
  };

  hide() {
    this.element.style.display = 'none';
  };
  
  show() {
    this.element.style.display = 'table-row';
  };
};