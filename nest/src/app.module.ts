import { Module } from '@nestjs/common';
import { AppController } from './app.controller';
import { AppService } from './app.service';

import { ConsumeEmailController } from './consume-email/consume-email.controller';
import { ConsumeEmailModule } from './consume-email/consume-email.module';
import { ConsumeEmailService } from './consume-email/consume-email.service';

@Module({
  imports: [ConsumeEmailModule],
  controllers: [AppController],
  providers: [AppService],
})
export class AppModule {}
