function handler() {
    return {
    fields: [],
    addNewContact() {
        this.fields.push({
            name_pic: '',
            position: '',
            phone_number: '',
        });
        },
        removeField(index) {
        this.fields.splice(index, 1);
        }
    }
}

function handlerAddFactory() {
    return {
    fields: [],
    addNewFactory() {
        this.fields.push({
            name_branch: '',
            type_branch: '',
            pic_branch: '',
            address_branch: '',
            desc_branch: '',
        });
        },
        removeField(index) {
        this.fields.splice(index, 1);
        }
    }
}