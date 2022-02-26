/* eslint-disable prettier/prettier */
import { ConsumeEmailService } from './consume-email.service';
import { Controller } from '@nestjs/common';

@Controller()
export class ConsumeEmailController {
  constructor(
      private readonly consumeEmailService: ConsumeEmailService,
    ) {}
}
