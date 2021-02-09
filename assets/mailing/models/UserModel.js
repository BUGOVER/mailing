/** @format */

import Model from '../base/Model';

export default class UserModel extends Model {
    formData = true;
    /**
     * @type {string}
     */
    scope = 'user';
    /**
     * @type {string}
     */
    primaryKey = 'user_id';
    /**
     * @type {string[]}
     */
    hidden = ['baseUrl'];

    /**
     * @type {{photo_file: string, patronymic: string, password: string, password_confirmation: string, phone: string, surname: string, name: string, nickname: string, description: string, salary: string, email: string, role_ids: string}}
     */
    rules = {
        last_name: 'required|min:3|max:25',
        first_name: 'required|min:3|max:25',
        email: 'required|email',
    };

    /**
     * @param user
     */
    constructor(user = {}) {
        super('mailings', '', '', {
            create: 'add_user',
            update: 'edit_user',
        });

        this.first_name = user.first_name;
        this.last_name = user.last_name;
        this.email = user.email;
    }
}
